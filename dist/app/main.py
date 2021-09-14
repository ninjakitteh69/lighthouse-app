#!/usr/bin/python3
import aiofiles
import asyncio
import json
import sys
import getopt
import os
from pathlib import Path

async def main(sourcefile):
    async with aiofiles.open(sourcefile, mode='r') as f:
        async for line in f:
            await asyncio.sleep(0)
            command = 'lighthouse --chrome-flags="--headless --no-sandbox" ' + line
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