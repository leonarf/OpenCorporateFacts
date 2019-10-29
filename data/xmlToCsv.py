#!/usr/bin/python3
# -*- coding: utf-8 -*-
import os, inspect
import io
import csv
import getopt, sys
import zipfile
import re
import requests
import json

import xml.etree.ElementTree as ET
from ftplib import FTP_TLS

databaseCompanyAdding = 0
databaseCompteAdding = 0
csvGenerated = 0
confidentiality2Count = 0
detailMissing = 0
requestHeaders = {'content-type': 'application/json'}
defaultValueForMissingData = "Missing Value"

dictionaryCodeMotifToHumanReadable = {
'0':'0 Comptes annuels saisis sans anomalie',
'1':'1 Comptes annuels saisis avec des incohérences comptables à la source du document',
'1A':'1A Comptes annuels saisis avec des données manquantes à la source du document',
'A1':'A1 Comptes annuels saisis à partir d’un document relivré',
'A2':'A2 Comptes annuels saisis sans contrôle BODACC possible',
'A3':'A3 Incohérence avec référentiel BODACC',
'A4':'A4 Incohérence entre la page de garde et le contenu de la liasse',
'A5':'A5 Doute sur le type de déclaration de confidentialité',
'2':'2 Comptes annuels non saisis ‐ Actif, Passif ou Compte de Résultat nul',
'3':'3 Comptes annuels non saisis ‐ Incomplets (des pages manquent) y compris IFRS',
'4':'4 Comptes annuels non saisis ‐ Non détaillés (uniquement totaux et sous totaux)',
'5':'5 Comptes annuels non saisis ‐ Reçus en double exemplaire (doublon « informatique »)',
'6':'6 Comptes annuels non saisis ‐ Reçus en double exemplaire (bilan «rescanné »)',
'7':'7 Comptes annuels non saisis ‐ Comptes intermédiaires, situation provisoire',
'8':'8 Comptes annuels non saisis ‐ Illisibles, présentant un cadre gris très foncé (cadre "totaux")',
'9':'9 Comptes annuels non saisis ‐ Illisibles, manuscrits',
'10':'10 Comptes annuels non saisis ‐ Illisibles, présentant des caractères trop gras',
'11':'11 Comptes annuels non saisis ‐ Illisibles, scannés en biais ou présentant des pages rognées',
'12':'12 Comptes annuels non saisis ‐ Illisibles, numérisés trop clairement',
'13':'13 Comptes annuels non saisis ‐ Autres motifs d''illisibilité',
'14':'14 Comptes annuels non saisis ‐ Date de dépôt < 2017 – Date exercice < 2016',
'15':'15 Comptes annuels non saisis ‐ Bilan de clôture de liquidation',
'16':'16 Document non saisi ‐ Ordonnance de Report d’Assemblée générale',
'17':'17 Document non saisi ‐ Refus du Tribunal de Commerce du Report de l''Assemblée générale',
'18':'18 Document non saisi ‐ Déclaration d’impôts',
'19':'19 Document non saisi ‐ Document autre que constitutif des comptes annuels',
'20':'20 Document non saisi ‐ Société immobilière',
'21':'21 Document non saisi ‐ Société étrangère',
'22':'22 Comptes annuels non saisis ‐ Déclaration de confidentialité incohérente',
'23':'23 Comptes annuels non saisis – Mélange de documents'
}

dictionaryColumnNameToDatabaseFields = {
      "Ventes de marchandises":["VenteMarchandises",2],
      "Production vendue biens":["ProductionVendueDeBiens",2],
      "Production vendue services":["ProductionVendueDeServices",2],
      "Chiffres d’affaires nets":["ChiffresAffairesNet",2],
      "Production stockée":["ProductionStocked",0],
      "Production immobilisée":["ProductionImmobilisee",0],
      "Subventions d’exploitation":["SubventionsExploitation",0],
      "Reprises sur amortissements et provisions, transfert de charges":["RepriseDepreciationProvisionsTransfertCharges",0],
      "Autres produits":["AutresProduits",0],
      "Total des produits d’exploitation (I)":["ProduitsExploitation",0],
      "Achats de marchandises (y compris droits de douane)":["AchatsDeMarchandises",0],
      "Variation de stock (marchandises)":["VariationStockMarchandise",0],
      "Achats de matières premières et autres approvisionnements":["AchatMatierePremiereAutreAppro",0],
      "Variation de stock (matières premières et approvisionnements)":["VariationStockMatierePremiereEtAppro",0],
      "Autres achats et charges externes":["AutresAchatEtChargesExternes",0],
      "Impôts, taxes et versements assimilés":["ImpotTaxesEtVersementsAssimiles",0],
      "Salaires et traitements":["SalairesEtTraitements",0],
      "Charges sociales":["ChargesSociales",0],
      "Dot. d’exploit. ‐ Dotations aux amortissements":["DotationAmortissementImmobilisations",0],
      "Dot. d’exploit. Sur actif circulant : dotations aux provisions":["DotationDepreciationActifCirculant",0],
      "Dot. d’exploit. Pour risques et charges : dotations aux provisions":["DotationProvisions",0],
      "Autres charges":["AutresCharges",0],
      "Total des charges d’exploitation (II)":["ChargesExploitation",0],
      "‐ RESULTAT D’EXPLOITATION (I ‐ II)":["ResultatExploitation",0],
      "Produits financiers de participations":["ProduitsFinanciersParticipations",0],
      "Produits des autres valeurs mobilières et créances de l’actif immobilisé":["ProduitsAutresValeursMobiliereEtCreancesActifImmobilise",0],
      "Autres intérêts et produits assimilés":["AutreInteretEtProduitAssimile",0],
      "Reprises sur provisions et transferts de charges financier":["RepriseDepreciationEtProvisionTransfertsCharges",0],
      "Différences positives de change":["DifferencesPositivesChange",0],
      "Produits nets sur cessions de valeurs mobilières de placement":["ProduitsNetsCessionsValeursMobilesPlacement",0],
      "Total des produits financiers (V)":["ProduitsFinanciers",0],
      "Dotations financières sur amortissements et provisions":["DotationsFinancieresAmortissementDepreciationProvision",0],
      "Intérêts et charges assimilées"   :["InteretEtChargeAssimilees", 0],
      "Différences négatives de change":["DifferenceNegativeChange",0],
      "Charges nettes sur cessions de valeurs mobilières de placement": ["ChargesNetteCessionValeurMobiliereDePlacement",0],
      "Total des charges financières (VI)"   :["ChargesFinancieres", 0],
      "‐ RESULTAT FINANCIER (V ‐ VI)"   :["ResultatFinancier", 0],
      "Produits exceptionnels sur opérations de gestion":["ProduitExceptionnelOperationGestion",0],
      "Produits exceptionnels sur opérations en capital":["ProduitExceptionnelOperationCapital",0],
      "Reprises sur provisions et transferts de charges exceptionnel":["RepriseDepreciationProvisionTransfertCharge",0],
      "Charges exceptionnelles sur opérations de gestion":["ChargesExceptionnelleOperationGestion",0],
      "Charges exceptionnelles sur opérations en capital":["ChargesExceptionnelleOperationCapital",0],
      "Dotations exceptionnelles aux amortissements et provisions":["DotationExceptionnelleAmortissementDepreciationProvision",0],
      "‐ RESULTAT EXCEPTIONNEL (VII ‐ VIII)":["ResultatExceptionnel",0],
      "Participation des salariés aux résultats de l’entreprise":["ParticipationSalariesAuxResultats",0],
      "Impôts sur les bénéfices":["ImpotsSurLesBenefices",0],
      "BENEFICE OU PERTE (Total des produits ‐ Total des charges)":["Benefice", 0],
      "Effectif moyen du personnel":["EffectifsMoyens",0],
      "Dividendes":["Dividende",0],
    };

def getNewCompteDeResultatToPost():
    dictionary = {
      "ChiffresAffairesNet": 0,
      "ProduitsExploitation": 0,
      "SalairesEtTraitements": 0,
      "ChargesSociales": 0,
      "ChargesExploitation": 0,
      "ChargesFinancieres": 0,
      "ProduitsFinanciers": 0,
      "year": 0,
      "ImpotTaxesEtVersementsAssimiles": 0,
      "SubventionsExploitation": 0,
      "AchatsDeMarchandises": 0,
      "ResultatExploitation": 0,
      "ResultatFinancier": 0,
      "ResultatExceptionnel": 0,
      "ParticipationSalariesAuxResultats": 0,
      "ImpotsSurLesBenefices": 0,
      "VenteMarchandises": 0,
      "ProductionVendueDeServices": 0,
      "ProductionImmobilisee": 0,
      "RepriseDepreciationProvisionsTransfertCharges": 0,
      "AutresProduits": 0,
      "AutresAchatEtChargesExternes": 0,
      "DotationAmortissementImmobilisations": 0,
      "DotationDepreciationImmobilisations": 0,
      "DotationDepreciationActifCirculant": 0,
      "DotationProvisions": 0,
      "AutresCharges": 0,
      "ProduitsFinanciersParticipations": 0,
      "ProduitsAutresValeursMobiliereEtCreancesActifImmobilise": 0,
      "RepriseDepreciationEtProvisionTransfertsCharges": 0,
      "DifferencesPositivesChange": 0,
      "DotationsFinancieresAmortissementDepreciationProvision": 0,
      "InteretEtChargeAssimilees": 0,
      "DifferenceNegativeChange": 0,
      "ChargesNetteCessionValeurMobiliereDePlacement": 0,
      "ProduitExceptionnelOperationGestion": 0,
      "ProduitExceptionnelOperationCapital": 0,
      "RepriseDepreciationProvisionTransfertCharge": 0,
      "ChargesExceptionnelleOperationGestion": 0,
      "ChargesExceptionnelleOperationCapital": 0,
      "DotationExceptionnelleAmortissementDepreciationProvision": 0,
      "Benefice": 0,
      "AutreInteretEtProduitAssimile": 0,
      "AchatMatierePremiereAutreAppro": 0,
      "VariationStockMarchandise": 0,
      "ProduitsNetsCessionsValeursMobilesPlacement": 0,
      "ProductionVendueDeBiens": 0,
      "ProductionStocked": 0,
      "VariationStockMatierePremiereEtAppro": 0,
      "EffectifsMoyens": -1,
      "Dividende": -1
    }
    return dictionary

dictionaryAdministrationToHuman = {}

def getHumanReadable(code):
    # Try to find human readable version of code
    if code in dictionaryCodeToHumanReadable:
        return dictionaryCodeToHumanReadable[code]
    # Try to remove leading '0' from the code to find a match in HumanReadableDictionary
    elif re.match('^[0-9]*$', code):
        code = code.lstrip('0')
        if code in dictionaryCodeToHumanReadable:
            return dictionaryCodeToHumanReadable[code]
    # Return code as is if no match :'-(
    print("code not found :", code)
    return code

def getMotifHumanReadable(code):
    # Try to find human readable version of code
    if code in dictionaryCodeMotifToHumanReadable:
        return dictionaryCodeMotifToHumanReadable[code]
    # Try to remove leading '0' from the code to find a match in HumanReadableDictionary
    elif re.match('^[0-9]*$', code):
        code = code.lstrip('0')
        if code in dictionaryCodeMotifToHumanReadable:
            return dictionaryCodeMotifToHumanReadable[code]
    # Return code as is if no match :'-(
    print("code not found :", code)
    return code

def parseIdentite(identite):
    dictionary = {}
    dictionary['siren'] = identite.find('inpi:siren', ns).text
    dictionary['denomination'] = identite.find('inpi:denomination', ns).text
    dictionary['code_activite'] = identite.find('inpi:code_activite', ns).text
    dictionary['adresse'] = identite.find('inpi:adresse', ns).text
    dictionary['date_cloture_exercice'] = identite.find('inpi:date_cloture_exercice', ns).text
    dictionary['date_cloture_exercice_n-1'] = identite.find('inpi:date_cloture_exercice_n-1', ns).text
    dictionary['code_type_bilan'] = identite.find('inpi:code_motif', ns).text
    dictionary['code_confidentialite'] = identite.find('inpi:code_confidentialite', ns).text
    dictionary['code_motif'] = identite.find('inpi:code_motif', ns).text
    dictionary['code_type_bilan'] = identite.find('inpi:code_type_bilan', ns).text

    return dictionary

def parseDetail(detail, compteType):
    dictionaryDetail = {}
    for page in detail:
        # Select only "Compte de résultat" and "Effectifs" and "Dividendes" pages
        if page.attrib['numero'] in ['02', '03', '04', '16', '5', '11'] :
            for liasse in page:
                # code details is ['description' 'colonnes remplies']
                try:
                    codeDetails = dictionaryAdministrationToHuman[compteType][page.attrib['numero']][liasse.attrib['code']]
                except KeyError:
                    print("KeyError exception for code " + liasse.attrib['code'] + " in page " + page.attrib['numero'] + " for compte type " + compteType)
                    return dictionaryDetail;
                liasseValues = []
                for digit in ['1', '2', '3' , '4']:
                    # Fill 'liasseValues' with value found in xml file from expected attribute (m1, m2, m3 or m4)
                    if digit in codeDetails[1]:
                        try:
                            attributeName = 'm' + digit
                            liasseValues.append(int(liasse.attrib[attributeName]))
                        except ValueError:
                            print ("Not a number for attribute " + attributeName + " in :", codeDetails[0], liasse.attrib)
                        except KeyError:
                            liasseValues.append(defaultValueForMissingData)
                if codeDetails[0] in dictionaryDetail and dictionaryDetail[codeDetails[0]] != liasseValues :
                    print ('ERROR! Two codes (second one is ' + liasse.attrib['code'] + " in page " + page.attrib['numero'] + " for compte type " + compteType + ') with same meaning (' + codeDetails[0] + ') found in xml file, and with differents values! First values:' , dictionaryDetail[codeDetails[0]], "Second values:", liasseValues)
                    return None
                dictionaryDetail[codeDetails[0]] = liasseValues
        else:
            print("page number not interesting :", page.attrib['numero'])

    return dictionaryDetail

def postOrGetCompanyInDatabase(corporateIdentity):
    global databaseCompanyAdding
    corporateIRI = None
    # Try to get corporate IRI, if it already exist
    response = requests.get(URLToFill + "api/corporates?CompanyNumber=" + corporateIdentity['siren'], headers=requestHeaders).json()
    if response['hydra:totalItems'] == 1:
        corporateIRI = response['hydra:member'][0]['@id']
        databaseCompanyAdding += 1
    else:
        # Post the company to database
        postCorporateDict = {'Name': corporateIdentity['denomination'],
                             'OpenCorporateURL': 'https://opencorporates.com/companies/fr/' + corporateIdentity['siren'],
                             'CompanyNumber': corporateIdentity['siren'],
                             'IndustryCode': corporateIdentity['code_activite']}
        jsonData = json.dumps(postCorporateDict)
        response = requests.post(URLToFill + "api/corporates", data=jsonData, headers=requestHeaders)
        if response.ok:
            corporateIRI = response.json()['@id']
            databaseCompanyAdding += 1
        elif response.status_code == 400:
            print(response.json()['hydra:description'])
            if response.json()['hydra:description'] == 'CompanyNumber: This value is already used.':
                print("CompanyNumber exists already, retrieving it")
            else:
                print("response.json() : ", response.json())
                print(response.json()['violations'])
                print(response.json()['violations'][0]['propertyPath'])
        else:
            print(response.reason)
            print(response.status_code)
            response.raise_for_status()
    return corporateIRI

def postCompteDeResultatToDatabase(year, corporateIRI, financialValues, compteNumber):
    # Try to get already existing bilan comptable
    response = requests.get(URLToFill + "api/compte_de_resultats?Corporate=" + corporateIRI + "&year=" + str(year), headers=requestHeaders)
    if response.ok and response.json()['hydra:totalItems'] == 1:
        print('There is already a compte for year', year, "for company " + corporateIRI)
        return True
    else:
        postCompteDeResultatDict = getNewCompteDeResultatToPost()
        postCompteDeResultatDict['Corporate'] = corporateIRI
        # Extract year from close date
        postCompteDeResultatDict['year'] = year

        # Use each value in financialValues to fill the request to post to database,
        # using dictionaryColumnNameToDatabaseFields to know what goes where
        for csvKey in financialValues:
            if csvKey in dictionaryColumnNameToDatabaseFields:
                try:
                    postCompteDeResultatDict[dictionaryColumnNameToDatabaseFields[csvKey][0]] = financialValues[csvKey][dictionaryColumnNameToDatabaseFields[csvKey][1] + compteNumber]
                    if postCompteDeResultatDict[dictionaryColumnNameToDatabaseFields[csvKey][0]] == defaultValueForMissingData:
                        print("Cannot post compte", year, "for company", corporateIRI, "because at least value for", dictionaryColumnNameToDatabaseFields[csvKey][0], "is missing")
                        return False
                except IndexError:
                    print("Error when getting value from xml to database. csvKey=", csvKey, "compteNumber=", compteNumber, dictionaryColumnNameToDatabaseFields[csvKey], "Values got in xml:", financialValues[csvKey])
                    postCompteDeResultatDict[dictionaryColumnNameToDatabaseFields[csvKey][0]] = defaultValueForMissingData
                    print("Cannot post compte", year, "for company", corporateIRI, "because at least value for", dictionaryColumnNameToDatabaseFields[csvKey][0], "is missing")
                    return False

        jsonData = json.dumps(postCompteDeResultatDict)
        response = requests.post(URLToFill + "api/compte_de_resultats", data=jsonData, headers=requestHeaders)
        if response.ok:
            print('Compte for year', year, " for company " + corporateIRI + "succesfully added :-D")
            return True
        elif response.status_code == 500:
            if 'uniqueComptesPerYearPerCorporate' in response.json()['hydra:description']:
                print('There is already a compte for year', postCompteDeResultatDict['year'], "for company " + corporateIdentity['denomination'] + " that was not found before")
                return True
        elif response.status_code == 400:
            print("Bilan comptable with error or missing values : " + response.json()['hydra:description'])
        else:
            print("Serveur error on post request. Details :")
            print("Response reason:", response.reason)
            print("Response status code:", response.status_code)
            print("URL: " + URLToFill + "api/compte_de_resultats")
            print("Data : " + jsonData)
            print("Headers :", requestHeaders)
            print(response.json()['hydra:description'])
            print("response.json() : ", response.json())
            return False

def postToDatabase(corporateIdentity, financialValues):
    global databaseCompteAdding
    compteAddingSuccess = 0
    corporateIRI = postOrGetCompanyInDatabase(corporateIdentity)
    year = int(corporateIdentity['date_cloture_exercice'][:4])
    if postCompteDeResultatToDatabase(year, corporateIRI, financialValues, 0):
        compteAddingSuccess += 1
    if postCompteDeResultatToDatabase(year - 1, corporateIRI, financialValues, 1):
        compteAddingSuccess += 1

    if compteAddingSuccess > 0:
        databaseCompteAdding += compteAddingSuccess
        return True
    else:
        return False

def writeCSV(corporateIdentity, financialValues):
    if outputFile:
        csvFilePath = outputFile
    else:
        csvFilePath = corporateIdentity['code_type_bilan'] + '_' + corporateIdentity['code_activite'] + '_' + corporateIdentity['adresse'].replace('/', 'sur') + '_' + corporateIdentity['siren'] + '_' + corporateIdentity['date_cloture_exercice'] + '.csv'

    with open(csvFilePath, 'w', newline='') as csvfile:
        csvWriter = csv.writer(csvfile, delimiter=';',
                               quotechar='"', quoting=csv.QUOTE_ALL)
        csvWriter.writerow(corporateIdentity)
        csvWriter.writerow(corporateIdentity.values())
        csvWriter.writerow(['Titre', 'le ' + corporateIdentity['date_cloture_exercice'], 'le ' + corporateIdentity['date_cloture_exercice_n-1']])
        for key, values in financialValues.items():
            values.insert(0, key)
            csvWriter.writerow(values)

def parseAndConvertXMLFile(xmlFilePath):
    global csvGenerated
    global confidentiality2Count
    global detailMissing
    tree = ET.parse(xmlFilePath)
    bilans = tree.getroot()
    for bilan in bilans.findall('inpi:bilan', ns):
        identite = bilan.find('inpi:identite', ns)
        identiteDict = parseIdentite(identite)
        if identiteDict['code_confidentialite'] == '2':
            print("not generating csv because confidentiality is ", identiteDict['code_confidentialite'])
            confidentiality2Count += 1
            return
        detail = bilan.find('inpi:detail', ns)
        if not detail:
            #if identiteDict['code_confidentialite'] != '0':
        #        print("no details because confidentiality is ", identiteDict['code_confidentialite'])
    #        else:
    #            print("WHY NO DETAIL?????? Maybe because :", getMotifHumanReadable(identiteDict['code_motif']))
            detailMissing += 1
            return
        typeCompte = "Complet"
        if identiteDict['code_type_bilan'] == 'S':
            typeCompte = "Simplifié"
        elif identiteDict['code_type_bilan'] == 'K':
            typeCompte = "Consolidé"
        elif identiteDict['code_type_bilan'] == 'B':
            typeCompte = "Banque"
        elif identiteDict['code_type_bilan'] == 'A':
            typeCompte = "Assurance"
        detailDict = parseDetail(detail, typeCompte)

        if detailDict != None and not postToDatabase(identiteDict, detailDict):
            writeCSV(identiteDict, detailDict)
            csvGenerated += 1

def processOneCompanyZippedFile(zipFilePath):
    print("Processing xml file ", zipFilePath)
    myzipfile = zipfile.ZipFile(zipFilePath)
    for zippedFile in myzipfile.namelist():
        if zippedFile.endswith(".xml"):
            myXmlFile = myzipfile.open(zippedFile)
            parseAndConvertXMLFile(myXmlFile)
            print("Global csv generation results : csvGenerated=", csvGenerated, "databaseCompteAdding=", databaseCompteAdding, "databaseCompanyAdding=", databaseCompanyAdding, "confidentiality2Count=", confidentiality2Count, "detailMissing=", detailMissing)

def processOneDayZippedFile(oneDayZipFilePath):
    try:
        oneDayZip = zipfile.ZipFile(oneDayZipFilePath)
        for zippedFileName in oneDayZip.namelist():
            if zippedFileName.endswith(".zip"):
                myXmlFile = oneDayZip.open(zippedFileName)
                processOneCompanyZippedFile(myXmlFile)
    except zipfile.BadZipFile:
        print("file " + oneDayZipFilePath + " cannot be handled by python zipfile :-(")

def exploreAndProcessFTPFolder(folderToExplore):
    ftp = FTP_TLS('opendata-rncs.inpi.fr')
    ftp.login(user='xxx', passwd = 'xxx')
    ftp.prot_p()
    elementList = ftp.nlst(folderToExplore)
    ftp.quit()
    for element in elementList:
        if element.endswith(".zip"):
            localFileName = os.path.basename(element)
            localfile = open(localFileName, 'wb')
            print("Downloading and processing file " + element)
            ftp = FTP_TLS('opendata-rncs.inpi.fr')
            ftp.login(user='xxx', passwd = 'xxx')
            ftp.prot_p()
            ftp.retrbinary("RETR " + element, localfile.write)
            ftp.quit()
            processOneDayZippedFile(localFileName)
        elif element.endswith(".md5"):
            print("md5 file to ignore ^^ :" + element)
        else:
            print("exploring " + element)
            exploreAndProcessFTPFolder(element)

def help():
    print('usage is :', os.path.basename(__file__), '-x <xmlFileToParse> -o <CSVFileToOutput>')
    print('      or :', os.path.basename(__file__), '-f <folder>')
    print('add option -r to upload to remote, or -l to upload to local server')

# Main

# Load code dictionaries from csv file
currentScriptPath = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe())))
with open(currentScriptPath + '/CodeEtSignification.csv', mode='r') as infile:
    csvReader = csv.reader(infile,  delimiter=';')
    line_count = 0
    for row in csvReader:
        if line_count == 0:
            line_count += 1
            continue
        row[4] = row[4].replace('"', '')
        if row[5] not in dictionaryAdministrationToHuman:
            dictionaryAdministrationToHuman[row[5]] = {row[4] : {row[1] : [row[2], row[3]]}}
        elif row[4] not in dictionaryAdministrationToHuman[row[5]] :
            dictionaryAdministrationToHuman[row[5]][row[4]] = {row[1] : [row[2], row[3]]}
        else:
            dictionaryAdministrationToHuman[row[5]][row[4]][row[1]] = [row[2], row[3]]

xmlFile = None
outputFile = None
folder = None
URLToFill = None
importFromFTP = False
try:
    opts, args = getopt.getopt(sys.argv[1:],"rlhx:o:f:",["xmlFile=","outputFile=", "folder=", "ftp"])
except getopt.GetoptError:
    help()
    sys.exit(2)
for opt, arg in opts:
    if opt == '-h':
        help()
        sys.exit()
    elif opt in ("-x", "--xmlFile"):
        xmlFile = arg
    elif opt in ("-o", "--outputFile"):
        outputFile = arg
    elif opt in ("-f", "--folder"):
        folder = arg
    elif opt == '-r':
        URLToFill = 'http://opencorporatefacts.fr/'
    elif opt == '-l':
        URLToFill = 'http://127.0.0.1:8000/'
    elif opt == '--ftp':
        importFromFTP = True

if not URLToFill:
    print("missing database/server URL, option -r or -l mandatory")
    help()
    sys.exit(2)
elif folder:
    print("folder given, will be parsed")
elif importFromFTP:
    print("ftp option given, take a nap")
elif xmlFile and outputFile:
    print("xml file given, will be parsed")
else:
    help()
    sys.exit(2)

# Declare XML namespace dictionary
ns = {'inpi': 'fr:inpi:odrncs:bilansSaisisXML'}

# Parse only one file if one file is given
if xmlFile:
    parseAndConvertXMLFile(xmlFile)
# Get data from FTP if ftp option is given
elif importFromFTP:
    folderToExplore = "public/Bilans_Donnees_Saisies/"
    dailyFileFound = exploreAndProcessFTPFolder(folderToExplore)
# Parse the given folder if option is given
else:
    for root, dirs, files in os.walk(folder):
        for name in files:
            if name.endswith(".zip"):
                filePath = root + name
                processOneCompanyZippedFile(filePath)
