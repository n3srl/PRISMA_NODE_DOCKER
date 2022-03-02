YOUR_CLIENT_NAME=prismanode &&\
cd /etc/openvpn &&\
cp /usr/share/doc/openvpn/examples/sample-config-files/client.conf $YOUR_CLIENT_NAME.ovpn && \
echo "key-direction 1" >> $YOUR_CLIENT_NAME.ovpn && \
echo "<ca>" >> $YOUR_CLIENT_NAME.ovpn && \
cat easy-rsa/pki/ca.crt >> $YOUR_CLIENT_NAME.ovpn && \
echo "</ca>" >> $YOUR_CLIENT_NAME.ovpn && \
echo "<cert>" >> $YOUR_CLIENT_NAME.ovpn && \
cat easy-rsa/pki/issued/$YOUR_CLIENT_NAME.crt >> $YOUR_CLIENT_NAME.ovpn && \
echo "</cert>" >> $YOUR_CLIENT_NAME.ovpn && \
echo "<key>" >> $YOUR_CLIENT_NAME.ovpn && \
cat easy-rsa/pki/private/$YOUR_CLIENT_NAME.key >> $YOUR_CLIENT_NAME.ovpn && \
echo "</key>" >> $YOUR_CLIENT_NAME.ovpn && \
echo "<tls-auth>" >> $YOUR_CLIENT_NAME.ovpn && \
cat server/ta.key >> $YOUR_CLIENT_NAME.ovpn && \
echo "</tls-auth>" >> $YOUR_CLIENT_NAME.ovpn
