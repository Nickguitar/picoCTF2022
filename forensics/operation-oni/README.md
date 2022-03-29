Arquivo de imagem de disco grande demais para upload

```sh
$ mmls disk.img
DOS Partition Table
Offset Sector: 0
Units are in 512-byte sectors

      Slot      Start        End          Length       Description
000:  Meta      0000000000   0000000000   0000000001   Primary Table (#0)
001:  -------   0000000000   0000002047   0000002048   Unallocated
002:  000:000   0000002048   0000206847   0000204800   Linux (0x83)
003:  000:001   0000206848   0000471039   0000264192   Linux (0x83)

$ sudo losetup -o 105906176 /dev/loop0 ~/MyCodes/picoCTF2022/operation_oni/disk.img
$ sudo fsck -fv /dev/loop0
fsck from util-linux 2.37.2
e2fsck 1.46.5 (30-Dec-2021)
Pass 1: Checking inodes, blocks, and sizes
Pass 2: Checking directory structure
Pass 3: Checking directory connectivity
Pass 4: Checking reference counts
Pass 5: Checking group summary information

        2378 inodes used (7.20%, out of 33048)
           1 non-contiguous file (0.0%)
          17 non-contiguous directories (0.7%)
             # of inodes with ind/dind/tind blocks: 0/0/0
             Extent depth histogram: 1955/3
      109285 blocks used (82.73%, out of 132096)
           0 bad blocks
           0 large files

        1583 regular files
         374 directories
           0 character device files
           0 block device files
           0 fifos
           1 link
         412 symbolic links (412 fast symbolic links)
           0 sockets
------------
        2370 files

$ sudo mount /dev/loop0 /mnt
$ sudo ssh -i /mnt/root/.ssh/id_ed25519 -p 58260 ctf-player@saturn.picoctf.net

$ ctf-player@challenge:~$ cat flag.txt
picoCTF{k3y_5l3u7h_b5066e83}
$ sudo umount /mnt
$ sudo losetup -d /dev/loop0
```