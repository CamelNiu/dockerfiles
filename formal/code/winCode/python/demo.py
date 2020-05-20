import time,redis,paramiko
from scp import SCPClient

#连接
conn = redis.Redis(host="127.0.0.1", port=6379,password="")

#重写
res = conn.bgrewriteaof()


#等待重写完毕
resPersistence = conn.info('persistence')
aofProgress = resPersistence['aof_rewrite_in_progress']
while  aofProgress == 1 :
    resPersistence = conn.info('persistence')
    aofProgress = resPersistence['aof_rewrite_in_progress']
    time.sleep(0.1)
#重写完毕


