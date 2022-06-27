'''
    下载网易云音乐列表
    download_url  列表链接
    download_api  下载链接
    download_path 下载保存位置 
'''

import requests
import re
from lxml import etree
import os
import time

download_url = 'https://music.163.com/discover/toplist?id=3778678'
download_api = 'https://music.163.com/song/media/outer/url?id='
download_path = './music163_'
listId = (download_url.split('=')[-1], time.strftime('%Y%m%d%a')) [download_url.split('=')[-1] == '']
download_path += listId
head = {
    'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'
}
respone = requests.get(download_url, headers=head)
# print(respone)

html = etree.HTML(respone.text)
list = html.xpath('//a[contains(@href,"song?")]')

for item in list:
    
    href = item.xpath('./@href')[0]
    
    music_id = href.split('=')[1]

    if re.match('\\d', music_id):

        if "$" not in music_id:

            music_name = item.xpath('./text()')[0]

            if not os.path.exists(download_path):
                os.mkdir(download_path)

            path = download_path + '/' + music_name + '.mp3'

            response = requests.get(url = download_api + music_id)

            with open(path, mode='wb') as f:

                f.write(response.content)

                f.close()
                
                print(music_id, ':【', music_name, '】下载完成\n')
