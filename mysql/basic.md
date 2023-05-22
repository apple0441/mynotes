# MySQL basic commands


> This article comes from the Internet, there may be errors and omissions, and it is for reference only.

### 1. Connect to MySQL: `mysql -h host_address -u user_name -p user_password`

```bash
mysql -h110.110.110.110 -u root -p 123;
```

### 2. Modify password: `mysqladmin -u user_name -p old_password password new_password`

```bash
mysqladmin -u root -p abc123 password def456;
```

### 3. Add a new user: `grant select on db_name.* to user_name@login_host identified by 'user_password'`

```bash
/* The mysql grant command adds three modes commonly used by users */
grant all PRIVILEGES on *.* to 'test'@'localhost' identified by '123';
grant all PRIVILEGES on *.* to 'test'@'%' identified by '123';
grant all PRIVILEGES on *.* to 'test'@'10.22.225.18' identified by '123';
```

> Description:
The first command adds a local user 'test', which is generally used when the web server and database server are together;
The second command adds a user 'test', which can be used as long as the machine can connect to the database server. This is more dangerous and generally not used;
The last command adds a user 'test' to the '10.22.225.18' machine on the database server, which is generally used when the web server and the database server are separated.


> Note:
When you actually use it, you will not use `grant all PRIVILEGES on *.*`, but set the relevant permissions according to actual needs.
For example `grant select,insert,delete,update on test.* to 'test'@'localhost' identified by '123';`


### 4. Create database: `create database db_name`

```
create database news;
```

### 5. Show databases: `show databases`

### 6. Drop the database: `drop database db_name`

```mysql
drop database news;
```

### 7. Connect to the database: `use db_name`

```mysql
use news;
```

The `use` statement can tell MySQL to use the `db_name` database as the default (current) database for subsequent statements. This database remains the default database until the end of the clause, or until a different `USE` statement is issued:

```
mysql> USE db1;
mysql> SELECT COUNT(*) FROM mytable; # selects from db1.mytable
mysql> USE db2;
mysql> SELECT COUNT(*) FROM mytable; # selects from db2.mytable
```

### 8. Selected database: `select method()`

The `SELECT` command in MySQL is similar to `print` or `write` in other programming languages, you can use it to display a string, number, the result of a mathematical expression, etc. How to use special features of `SELECT` command in `MySQL`?

① Display the version of MYSQL

```mysql
mysql> select version();
+-----------------------+
| version() |
+-----------------------+
|6.0.4-alpha-community|
+-----------------------+
1 row in set (0.02 sec)
```

② Display the current time

```mysql
mysql> select now();
+---------------------+
| now() |
+---------------------+
| 2009-09-15 22:35:32 |
+---------------------+
1 row in set (0.04 sec)
```

③ Display the year, month and day

```mysql
SELECT DAYOFMONTH(CURRENT_DATE);
+--------------------------+
| DAYOFMONTH (CURRENT_DATE) |
+--------------------------+
| 15 |
+--------------------------+
1 row in set (0.01 sec)
  
SELECT MONTH(CURRENT_DATE);
+---------------------+
| MONTH(CURRENT_DATE) |
+---------------------+
| 9 |
+---------------------+
1 row in set (0.00 sec)
  
SELECT YEAR(CURRENT_DATE);
+--------------------+
|YEAR(CURRENT_DATE)|
+--------------------+
| 2009 |
+--------------------+
1 row in set (0.00 sec)
```

④ Display character string

```mysql
mysql> SELECT "welcome to my blog!";
+----------------------+
| welcome to my blog! |
+----------------------+
| welcome to my blog! |
+----------------------+
1 row in set (0.00 sec)
```

⑤ Used as a calculator

```mysql
select ((4 * 4) / 10 ) + 25;
+----------------------+
| ((4 * 4) / 10 ) + 25 |
+----------------------+
| 26.60 |
+----------------------+
1 row in set (0.00 sec)
```

⑥ Concatenating strings

```mysql
select CONCAT(f_name, " ", l_name)
AS Name
from employee_data
where title = 'Marketing Executive';
+---------------+
| Name |
+---------------+
| Monica Sehgal |
| Hal Simlai |
| Joseph Irvine |
+---------------+
3 rows in set (0.00 sec)
```

> Note: The `CONCAT()` function is used here to concatenate strings. In addition, we also used the previously learned `AS` to alias the result column `'CONCAT(f_name, " ", l_name)'`.

### 9. Create a data table: `create table table_name (field_1_name field_1_type [ ,... field_n_name field_n_type ])`


```mysql
CREATE TABLE IF NOT EXISTS `user` (
   `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `user_name` varchar(20) DEFAULT NULL,
   `user_password` varchar(32) DEFAULT NULL,
   `user_email` varchar(40) DEFAULT NULL,
   PRIMARY KEY (`uid`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
```

### 10. Get table structure: `desc table_name` or `show columns from table_name`

> When using the MySQL database desc table name, we see that the Key column may have 4 values, namely `' '`, `'PRI'`, `'UNI'`, `'MUL'`.

① If `Key` is empty, then the column value can be repeated, indicating that the column has no index, or is a non-leading column of a non-unique composite index;

② If `Key` is `PRI`, then the column is a component of the primary key;

③ If `Key` is `UNI`, then this column is the first column (leading column) of a unique value index, and cannot contain null values (`NULL`);

④ If `Key` is `MUL`, then the value of this column can be repeated, this column is the leading column (first column) of a non-unique index or a component of a unique index but can contain the null value `NULL` .
If the definition of a column satisfies more than one of the above four conditions at the same time, for example, a column is both `PRI` and `UNI`, then when `desc table_name` is displayed, the displayed `Key` value is displayed according to the priority `PRI->UNI->MUL`. Then at this time, `PRI` is displayed.
A unique index column can be displayed as `PRI`, and the column cannot contain null values, and the table does not have a primary key.
A unique index column can be displayed as `MUL`, if multiple columns constitute a unique composite index, because although the multi-column combination of the index is unique, such as `ID+NAME` is unique, but there is no single column Duplicate values are still allowed, as long as `ID+NAME` is unique.

### 11. Drop table: `drop table table_name`

`DROP TABLE` is used to drop one or more tables. You must have `DROP` permission for each table. All table data and table definitions will be canceled, so use this statement with care!

### 12. Table insert data: `insert into table_name ( field_1_name [ ,... field_n_name ]) values ( value_1 [,... value_n ] )`

```mysql
INSERT INTO user (`uid`, `user_name`, `user_password`, `user_email`) VALUES (1, 'admin', 'admin', 'admin@example.com');
```
`insert into` can only insert one record into the table at a time.
### 13. Query table data: `select field_1_name [,... field_n_name ] from table_name where sql_expression`

① Query all rows:

View all data in the table `user`
`select * from user;`

② Query the first few rows of data:

View the first 2 rows of data in the table user
`select * from user order by id limit 0,2;`
> Note: `select` is generally used together with `where` to query more precise and complex data.

### 14. Delete the data in the table: `delete from table_name where sql_expression`

Delete the record numbered 1 in the table user
`delete from user where uid=1;`

### 15. Modify the data in the table: `update table_name set field_name = new_value [ ,…] where sql_expression`

For example, to update `user` whose `id` is `1`, set the `user_name` field value to `Mary`.

```mysql
update user set user_name='Mary' where id=1;
```

① MySQL UPDATE statement for a single table:

`UPDATE [LOW_PRIORITY] [IGNORE] tbl_name SET col_name1=expr1 [, col_name2=expr2 ...] [WHERE where_definition] [ORDER BY ...] [LIMIT row_count]`

② UPDATE statement for multiple tables:

`UPDATE [LOW_PRIORITY] [IGNORE] table_references SET col_name1=expr1 [, col_name2=expr2 ...] [WHERE where_definition]`

The `UPDATE` syntax updates columns in an existing table row with new values. The `SET` clause indicates which columns to modify and which values to give. The `WHERE` clause specifies which rows should be updated. If there is no `WHERE` clause, all rows are updated. If the `ORDER BY` clause is specified, the rows are updated in the order specified. The `LIMIT` clause is used to give a limit, limiting the number of rows that can be updated.

### 16. Add field: `alter table table_name [ add field_name field_type / other_sql_expression ]`

Added a field `user_pic` in the table `user`, the type is `varchar(40)`, the default value is `NULL`
`alter table user add user_pic varchar(40) default NULL;`

index
`alter table employee add index emp_name (name);`

index with primary key
`alter table employee add primary key(id);`

Index with unique constraints
`alter table employee add unique emp_name2(cardnumber);`

delete an index
`alter table employee drop index emp_name;`

add field
`alter table user add user_pic varchar(40) default NULL;`

Modify the original field name and type
`ALTER TABLE table_name CHANGE old_field_name new_field_name field_type;`

delete field
`ALTER TABLE table_name DROP field_name;`

### 17. Modify the table name: `rename table old_table_name to new_table_name`

You cannot have any locked tables or active transactions when you execute `RENAME`. You must also have `ALTER` and `DROP` privileges on the original table, and `CREATE` and `INSERT` privileges on the new table.
If `MySQL` encounters any errors during a multi-table rename, it will rename all the tables being renamed backwards, returning everything to its original state.

### 18. Backup database:

① Export the entire database, the export file is stored in the mysql\bin directory by default
     `mysqldump -u user_name -p user_password db_name > new_db_name.sql`

② Export a table
     `mysqldump -u user_name -p user_password database_name table_name > outfile_name.sql`

③ Export a database structure
     `mysqldump -u user_name -puser_password -d -add-drop-table database_name > outfile_name.sql`
     `-d` no data `-add-drop-table` add a `drop table` before each `create` statement

④ Export with language parameters
     `mysqldump -u user_name -p user_password -default-character-set=latin1 -set-charset=gbk -skip-opt database_name > outfile_name.sql`

### 19. Example of building database and table:

```mysql
drop database if exists school; //Delete if SCHOOL exists
create database school; //Build library SCHOOL
use school; //Open library SCHOOL
create table teacher //create table TEACHER
(
     id int(3) auto_increment not null primary key,
     name char(10) not null,
     address varchar(50) default 'Shenzhen',
     year date
); //End of table creation

//The following is the inserted field
insert into teacher values(",'allen','Dalian No.1 Middle School','1976-10-10');
insert into teacher values(",'jack','Dalian No. 2 Middle School','1975-12-23');
```

If you type the above command at the `mysql` prompt, it will work, but it is not convenient for debugging.

① You can write the above command into a text file, assuming it is `school.sql`, then copy it to `c:\`, and enter the directory `mysql\bin` in `DOS` state, and then type the following command :
`mysql -u user_name -p user_password < c:\school.sql`

If successful, there will be no display for a blank line; if there is an error, there will be a prompt. (The above command has been debugged, you only need to remove the comment of // to use it).

② Or use `mysql> source c:\school.sql;` after entering the command line to import the `school.sql` file into the database.