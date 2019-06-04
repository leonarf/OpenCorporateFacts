#!/usr/bin/python3
# -*- coding: utf-8 -*-
import os, inspect
import io
import csv
import getopt, sys
import zipfile
import re

import xml.etree.ElementTree as ET

csvGenerated = 0
confidentiality2Count = 0
detailMissing = 0

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
#                print(compteType + " page " + page.attrib['numero'])
                # code details is ['description' 'colonnes remplies']
                codeDetails = dictionaryAdministrationToHuman[compteType][page.attrib['numero']][liasse.attrib['code']]
                liasseValues = []
                for digit in ['1', '2', '3' , '4']:
                    if digit in codeDetails[1]:
                        try:
                            attributeName = 'm' + digit
                            liasseValues.append(int(liasse.attrib[attributeName]))
                        except ValueError:
                            print ("Not a number for attribute " + attributeName + " in :", codeDetails[0], liasse.attrib)
                        except KeyError:
                            print ("Missing attribute " + attributeName + " in :", codeDetails[0], liasse.attrib)
                            liasseValues.append("Missing Value")
                if codeDetails[0] in dictionaryDetail:
                    raise Exception('Key conflict. the following key is not unique : "' + codeDetails[0] + '"')
                dictionaryDetail[codeDetails[0]] = liasseValues
        else:
            print("page number not interesting :", page.attrib['numero'])
    return dictionaryDetail

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
        writeCSV(identiteDict, detailDict)
        csvGenerated += 1

def help():
    print('usage is :', os.path.basename(__file__), '-x <xmlFileToParse> -o <CSVFileToOutput>')
    print('      or :', os.path.basename(__file__), '-f <folder>')

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
try:
    opts, args = getopt.getopt(sys.argv[1:],"hx:o:f:",["xmlFile=","outputFile=", "folder="])
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

if (not xmlFile or not outputFile) and not folder:
    help()
    sys.exit(2)

# Declare XML namespace dictionary
ns = {'inpi': 'fr:inpi:odrncs:bilansSaisisXML'}

if xmlFile:
    parseAndConvertXMLFile(xmlFile)
else:
    for root, dirs, files in os.walk(folder):
        for name in files:
            if name.endswith(".zip"):
                filePath = root + name
                myzipfile = zipfile.ZipFile(filePath)
                for zippedFile in myzipfile.namelist():
                    if zippedFile.endswith(".xml"):
                        myXmlFile = myzipfile.open(zippedFile)
                        parseAndConvertXMLFile(myXmlFile)
    print("Global csv generation results : csvGenerated=", csvGenerated, "confidentiality2Count=", confidentiality2Count, "detailMissing=", detailMissing)
