```sh
$ mmls  disk.flag.img
DOS Partition Table
Offset Sector: 0
Units are in 512-byte sectors

      Slot      Start        End          Length       Description
000:  Meta      0000000000   0000000000   0000000001   Primary Table (#0)
001:  -------   0000000000   0000002047   0000002048   Unallocated
002:  000:000   0000002048   0000206847   0000204800   Linux (0x83)
003:  000:001   0000206848   0000411647   0000204800   Linux Swap / Solaris x86 (0x82)
004:  000:002   0000411648   0000819199   0000407552   Linux (0x83)

$ sudo sudo losetup -o 210763776 /dev/loop0 ~/MyCodes/picoCTF2022/operation_orchid/disk.flag.img
$ sudo fsck -fv /dev/loop0
fsck from util-linux 2.37.2
e2fsck 1.46.5 (30-Dec-2021)
Pass 1: Checking inodes, blocks, and sizes
Pass 2: Checking directory structure
Pass 3: Checking directory connectivity
Pass 4: Checking reference counts
Pass 5: Checking group summary information

        2386 inodes used (4.68%, out of 51000)
           1 non-contiguous file (0.0%)
          16 non-contiguous directories (0.7%)
             # of inodes with ind/dind/tind blocks: 0/0/0
             Extent depth histogram: 1962/1
      121065 blocks used (59.41%, out of 203776)
           0 bad blocks
           0 large files

        1587 regular files
         375 directories
           0 character device files
           0 block device files
           0 fifos
           1 link
         415 symbolic links (415 fast symbolic links)
           0 sockets
------------
        2378 files

$ sudo mount /dev/loop0 /mnt
$ sudo ls -la /mnt/root
total 4
drwx------  2 root root 1024 Oct  6 15:32 .
drwxr-xr-x 22 root root 1024 Oct  6 15:30 ..
-rw-------  1 root root  202 Oct  6 15:33 .ash_history
-rw-r--r--  1 root root   64 Oct  6 15:32 flag.txt.enc

$ cat /mnt/root/.ash_history 
touch flag.txt
nano flag.txt 
apk get nano
apk --help
apk add nano
nano flag.txt 
openssl
openssl aes256 -salt -in flag.txt -out flag.txt.enc -k unbreakablepassword1234567
shred -u flag.txt
ls -al
halt

$ openssl aes256 -d -salt -in /mnt/flag.txt.enc -out /mnt/root/flag.txt -k unbreakablepassword1234567
$ cat /mnt/root/flag.txt
picoCTF{h4un71ng_p457_0a710765}

$ sudo umount /mnt
$ sudo losetup -d /dev/loop0
```