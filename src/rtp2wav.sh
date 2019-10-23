#!/usr/bin/env bash

ssrc=$(sudo tshark -n -r capture.pcap -2 -R rtp -T fields -e rtp.ssrc -E separator=, -d udp.port==51926,rtp | sort -u)
echo $ssrc
sudo tshark -n -r capture.pcap -2 -R rtp -R "rtp.ssrc == $ssrc" -T fields -e rtp.payload -d udp.port==51926,rtp | sudo tee payloads
for payload in `cat payloads`;
do IFS=:;
    for byte in $payload;
    do sudo printf "\\x$byte" >> sound.raw;
    done;
done
echo "sox has converted pcap to wav file"
sudo sox -t raw -r 8000 -c 1 -e mu-law sound.raw capture3d.wav