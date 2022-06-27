import you_get
import threading
import os
import time

def download1080(count,url):
    print("thread "+ str(count) +" is running")
    os.system("you-get --format=flv "+url)

def download720(count,url):
    print("thread "+ str(count) +" is running")
    os.system("you-get --format=dash-flv720 "+url)

def downloaddefault(count,url):
    print("thread "+ str(count) +" is running")
    os.system("you-get "+url)

def showinfo(count,url):
    print("thread "+ str(count) +" is running")
    os.system("you-get -i "+url)

def test(arg):
    print("thread "+ str(arg) +" is running")
    os.system("ping www.baidu.com")
    print("thread "+ str(arg) +" finish")


if __name__ == '__main__':

    url_seed = 'https://www.bilibili.com/video/BV1zR4y1t7Wj?p='
    thread_list = []
    url_num = 182
    thread_num = 5

    for i in range(1,url_num+1):
        #为每个新URL创建下载线程
        url = url_seed + str(i)
        t = threading.Thread(target=download1080, args=(i,url))
        #加入线程池并启动
        thread_list.append(t)
        t.start()
        
        #print(thread_list[0])

        #当线程池满时，等待线程结束
        while len(thread_list)>thread_num:  
            #移除已结束线程
            thread_list = [x for x in thread_list if x.is_alive()]
            time.sleep(10)
           # print("running threads_________" + str(thread_list))

        pass