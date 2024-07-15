import mysql.connector
from mysql.connector import Error
import time


class PRISMASQLCLIENT():
    def __init__(self, host_name, \
        user_name='root', user_password=None, db_name=None):
        #self.connection = None
        self.connection = mysql.connector.connect(
                host=host_name,
                user=user_name,
                passwd=user_password,
                db=db_name
            )

    def getDbInstance(self):
        return self.connection

    def replace_query(self, query):
        cursor = self.connection.cursor()
        #print(query)
        cursor.execute(query)
        self.connection.commit()
        cursor.close()

    def select_query(self, query):
        cursor = self.connection.cursor()
        list = []
        try:
            cursor.execute(query)
            rt = cursor.fetchone()
            while(rt != None):
                list.append(rt)
                rt = cursor.fetchone()
            cursor.close()
        except mysql.connector.Error as err:
            print("Error -- "+str(err))
        return list

    #Static methods ---------

    @staticmethod
    def build_multiple_insert_query(header, name_table, list_insertion):
        if(len(list_insertion) != 0):
            output_query = "REPLACE INTO `"+name_table+"` "
            output_query = output_query+header+" VALUES "
            for elem in list_insertion:
                output_query = output_query+str(elem)+","
            output_query = output_query[:-1]
            return output_query
        else:
            return ""

    #Testing ---------

    def test_query_select(self):
        sql = 'SELECT * FROM pr_node'
        mylist = self.select_query(sql)
        print(*mylist,sep='\n')