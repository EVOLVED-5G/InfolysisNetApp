
jq -r .capif_host=\"$CAPIF_HOSTNAME\" /var/www/capif_certificates/capif_registration.json >> tmp.json && mv tmp.json /var/www/capif_certificates/capif_registration.json
jq -r .capif_http_port=\"$CAPIF_PORT_HTTP\" /var/www/capif_certificates/capif_registration.json >> tmp.json && mv tmp.json /var/www/capif_certificates/capif_registration.json
jq -r .capif_https_port=\"$CAPIF_PORT_HTTPS\" /var/www/capif_certificates/capif_registration.json >> tmp.json && mv tmp.json /var/www/capif_certificates/capif_registration.json


evolved5g register-and-onboard-to-capif --config_file_full_path="/var/www/capif_certificates/capif_registration.json" --environment="$ENVIRONMENT_MODE"

#tail -f /dev/null
