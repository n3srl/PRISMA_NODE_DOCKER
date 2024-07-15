from paramiko.client import AutoAddPolicy, SSHClient

class PRISMASSHClient:
    def __init__(self, address, user=None, passwd=None):
        self.client = SSHClient()
        self.client.set_missing_host_key_policy(AutoAddPolicy())
        self.client.load_system_host_keys()
        if user is None:
            self.client.connect(address)
        else:
            if passwd is not None:
                self.client.connect(address, username=user, password=passwd)
            else:
                self.client.connect(address, username=user)

    def close(self):
        self.client.close()

    def list_from_directory(self, directory):
        stdin, stdout, stderr = self.client.exec_command("ls " + directory)
        result = stdout.read().splitlines()
        return result

    def download_file(self, remote_filepath, local_filepath):
        sftp = self.client.open_sftp()
        sftp.get(remote_filepath, local_filepath)
        sftp.close()

    def size_of_file(self, remote_filepath):
        sftp = self.client.open_sftp()
        stat = sftp.stat(remote_filepath)
        sftp.close()
        return stat.st_size

    def list_from_directory_formatted(self, directory):
        list_files = self.list_from_directory(directory)
        listDecode = [x.decode() for x in list_files]
        # i=0
        # for elem in list_files:
        #     list_files = elem.decode('utf-8')
        #     i = i+1
        
        # for i in range(len(list_files)):
        #     list_files[i] = list_files[i].decode('utf-8')
        return listDecode

    def stat_from_directory(self, directory):
        stdin, stdout, stderr = self.client.exec_command("stat " + directory)
        result = stdout.read().splitlines()
        return result

    #ONLY DETECT EDIT IN THE SPECIFED FOLDER, 
    #NOT IN SUBFOLDER OF THE SPECIFIED FOLDER
    #So use this only on folders that directly containts
    #the files/folder registred in the db
    def modifiedStat_from_directory(self, directory):
        result = self.stat_from_directory(directory)
        modified_date = result[5].decode('utf-8')
        modified_date = modified_date[8:]
        modified_date = modified_date.split('.')[0]
        return modified_date