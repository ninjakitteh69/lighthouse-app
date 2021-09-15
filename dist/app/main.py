#!/usr/bin/python3
import aiofiles
import asyncio
import json
import sys
import getopt
import os
import subprocess

async def main(sourcefile):
    async with aiofiles.open(sourcefile, mode='r') as f:
        async for line in f:
            if(not line.startswith('http://') or not line.startswith('https://')):
                line = 'http://' + line
            command = 'lighthouse ' + line.strip('\n\r') + ' --chrome-flags="--headless --no-sandbox" --output html json'
            url=line.strip("http://").strip("https://").strip('\n\r')
            ns_records = subprocess.check_output("dig +short NS " + url.strip('www.'), shell=True).decode("utf-8").splitlines()
            mx_records = subprocess.check_output("dig +short MX " + url.strip('www.'), shell=True).decode("utf-8").splitlines()
            a_records = subprocess.check_output("dig +short A " + url, shell=True).decode("utf-8").splitlines()
            f = open("/var/www/html/dns/" + url + ".json", "w")
            f.write(json.dumps({'ns': ns_records, 'mx': mx_records, 'a': a_records}))
            f.close()

            # await asyncio.create_subprocess_shell(command)
            os.system(command)

#defining variables
inputfile = ""
outputpath = ""
argv = sys.argv[1:]

try:
    opts, args = getopt.getopt(argv,"hi:o:")
except getopt.GetoptError:
    print('main.py -i <inputfile> -o <outputpath>')
    sys.exit(2)
for opt, arg in opts:
    if opt == '-h':
        print('main.py -i <inputfile> -o <outputpath>')
        sys.exit()
    elif opt in ("-i"):
        inputfile = arg
if not bool(inputfile):
    print('Missing args. Usage: main.py -i <inputfile>')
    print(args)
    sys.exit()
else:
    asyncio.run(main(inputfile))