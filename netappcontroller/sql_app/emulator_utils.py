from evolved5g import swagger_client
from evolved5g.swagger_client import LoginApi, User
from evolved5g.swagger_client.models import Token
import os

def get_token() -> Token:

    with open('token_credentials.txt', 'r') as f:
        lines = f.read().splitlines()

    username = lines[0]
    password = lines[1]

    configuration = swagger_client.Configuration()
    configuration.verify_ssl=False
    # The host of the 5G API (emulator)
    configuration.host = get_host_of_the_nef_emulator()
    api_client = swagger_client.ApiClient(configuration=configuration)
    api_client.select_header_content_type(["application/x-www-form-urlencoded"])
    api = LoginApi(api_client)
    token = api.login_access_token_api_v1_login_access_token_post("", username, password, "", "", "")
    return token


def get_api_client(token) -> swagger_client.ApiClient:
    configuration = swagger_client.Configuration()
    configuration.host = get_host_of_the_nef_emulator()
    configuration.access_token = token.access_token
    configuration.verify_ssl=False
    api_client = swagger_client.ApiClient(configuration=configuration)
    return api_client


def get_host_of_the_nef_emulator() -> str:
    return os.getenv('NEF_HOSTNAME')
    #return "https://localhost:4443"

def get_folder_path_for_certificated_and_capif_api_key()->str:
    return  "/var/www/capif_certificates"

def get_capif_host()->str:
    return os.getenv('CAPIF_HOSTNAME')

def get_capif_https_port()->int:
    return os.getenv('CAPIF_PORT_HTTPS')