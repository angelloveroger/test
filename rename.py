from hashlib import new
import os

oldname = os.listdir()
for item in oldname:
    # print(item)
    # print('oldname:' + item)
    newName = item.replace('golang入门到项目实战 (2022最新Go语言教程，没有废话，纯干货！) (', 'golang-')
    # print(newName)
    newName = newName.replace(')', '')
    os.rename(item, newName)
    print('success')