#!/usr/bin/env python3
import MySQLdb
import numpy as np # linear algebra
import pandas as pd # data processing, CSV file I/O (e.g. pd.read_csv)
import datetime
import random
import matplotlib.pyplot as plt
import PyQt5

# For Linear Regression Start
def estimate_coef(x, y): 
    # number of observations/points 
    n = np.size(x) 
  
    # mean of x and y vector 
    m_x, m_y = np.mean(x), np.mean(y) 
  
    # calculating cross-deviation and deviation about x 
    SS_xy = np.sum(y*x) - n*m_y*m_x 
    SS_xx = np.sum(x*x) - n*m_x*m_x 
  
    # calculating regression coefficients 
    b_1 = SS_xy / SS_xx 
    b_0 = m_y - b_1*m_x 
  
    return(b_0, b_1) 
def plot_regression_line(x, y, b): 
    # plotting the actual points as scatter plot 
    plt.scatter(x, y, color = "m", 
               marker = "o", s = 30) 
  
    # predicted response vector 
    y_pred = b[0] + b[1]*x 
  
    # plotting the regression line 
    plt.plot(x, y_pred, color = "g") 
  
    # putting labels 
    plt.xlabel('x') 
    plt.ylabel('y') 
  
    # function to show plot 
    plt.show() 
# Linear Regression End

# To convert date to integer
def to_integer(dt_time):
    return 10000*dt_time.year + 100*dt_time.month + dt_time.day

# Main Code Starts
if __name__ == "__main__": 

    db = MySQLdb.connect(user="root"
    ,passwd=""
    ,db="project_inv"
    ,unix_socket="/opt/lampp/var/mysql/mysql.sock")   # name of the database
    
    # Create a Cursor object to execute queries.
    cur = db.cursor()
    
    # Select data from table using SQL query.
    cur.execute("SELECT * FROM invoice_details")
    # print(cur)
    product_data = []
    # print the first and second columns      
    for row in cur.fetchall() :
        # print (row)
        product_data.append(list(row))
    # print(product_data)
    cur.execute("SELECT * FROM invoice")
    i = 0
    for row in cur.fetchall() :
        for j in range(i,len(product_data)):
            if(product_data[j][1]==list(row)[0]):
                product_data[j].append(list(row)[2])
                product_data[j].append(list(row)[6])
        i=i+1
    
    # print("Printing the reformed dataset formed by joining 2 tables' particular\n rows(For more details ask Rahil)")
    # for i in product_data:
    #     print(i)
    
    # print('\n\n')
   
    #Market-Basket Analysis Code
    items=[]
    for row in product_data:
        ele=row[2]
        if ele not in items:
            items.append(ele)
    #print(items)
    len_items=len(items)

    dict1={} #for product with number
    dict2={} #for number with count
    matrix=[] #for analysis
    t=[]
    my_count = 0
    count=0

    for i in range(len_items):
        matrix.append([0 for j in range(len_items)])

    #print(matrix)
    
    for ele in items: 
        dict1[ele]=count
        dict2[count]=ele
        count+=1
    #print(dict1)
    #print(dict2)

    invoice_num=[]
    same_inv=[]
    
    for row in product_data:
        temp=[]
        temp.append(row[2])
        if row[1] not in invoice_num:
            invoice_num.append(row[1])
            same_inv.append(temp)
        else:
            index=invoice_num.index(row[1])
            same_inv[index].append(row[2])

    #print(same_inv)

    #formation of matrix
    for ele in items:
        #print('Ele=',ele)
        for act_list in same_inv:
            #print("list=", act_list)
            if len(act_list)>1 and ele in act_list:
                #print("Inside the if statement, group found")
                ind_ele=dict1[ele]
                #print(ele,"has an index of",dict1[ele])
                for act_item in act_list:
                    if act_item!=ele:
                        #print("list-ele=", ele,"act_item=", act_item)
                        ind_val=dict1[act_item]
                        #print(act_item,"has an index of",dict1[act_item])
                        #print("Original matrix",matrix)
                        matrix[ind_ele][ind_val]+=1
                        #print("matrix after first changes",ind_ele, ind_val,'are' ,matrix)
                        matrix[ind_val][ind_ele]+=1
                        #print("matrix after second changes",ind_val,ind_ele,'are',matrix)
                    #print("+++++++++++++++++")
                #print("***************")
        #print("=============")
    #print("_____________________")
    
    f = open("Basketanalysis.txt", "w")
    


    #print(matrix)
    print("Suggestions to User")
    f.write("Suggestions to User<br>\n")
    for_rahil=[] #for your UI output. You can relate it with the dict1/dict2 value
    for row in matrix:
        temp=[]
        s=''
        ind_row=matrix.index(row)
        for_rahil.append(temp)
        max_val=max(row)
        print("With", dict2[ind_row], "also buy", end=" ")
        value = "With <strong>"+ dict2[ind_row]+"</strong> also buy "
        f.write(value)
        # f.write("With", dict2[ind_row], "also buy", end=" ")
        count_ele=0
        for ele in row:
            if ele == max_val:
                s=s+dict2[count_ele]+", "
                for_rahil[ind_row].append(dict2[count_ele])
                #print(dict2[ind_ele])
            count_ele+=1
        print(s[:-2])
        print(s[:-2])
        f.write("<strong>"+s[:-2]+"</strong>")
        f.write("<br>\n")

    # print(for_rahil)
    f.close()