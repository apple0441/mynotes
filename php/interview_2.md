# Summary of PHP interview questions (2)

Most of the interview questions come from the Internet. Due to multiple reprints, the original source is no longer known, so the links will not be listed one by one. Everyone is welcome to leave a message on the `issue` page to discuss issues.

Source of problem:

http://tieba.baidu.com/p/3612369052
http://blog.csdn.net/hyr352114576/article/details/49638345
https://my.oschina.net/u/574366/blog/64814


## Self-expression questions

> There is no fixed/reference answer, just express it in combination with the question and your own reality.

### Briefly introduce yourself,? Then talk about your favorite works in the past three years?

Comments:
A. This question examines how your description matches your resume;
B. From the description, find the points that can be questioned, and ask for details, whether you really participated and how much you participated;
C. Locate and evaluate your capabilities from the project cycle, responsibilities, and complex procedures.

### After reading your resume, the interviewer will ask you about the number of users, PV, throughput, related difficulties and solutions of the project you are working on.

Comments:
Ditto.

### If you are the designer of 12306 train ticket booking, how should you design to satisfy the people of the whole country?

Reference answer: https://www.zhihu.com/question/20017917

### If there are 100 million user visits, what is your server architecture? How to design the storage scheme for user information?

Comments:
A. This question and answer is also relatively general, and it examines the analytical thinking for solving a problem;
B. From which aspects and levels to investigate the problem;
C. For the aspects and levels that come to mind, carefully dig and consider whether it is rigorous;
D. User information storage Investigate the interviewer's understanding of the user information business itself, the storage method and its characteristics.

### If you are the technical team leader, what should you do if the task progress of the team you lead cannot be completed? If you insert a task when the progress is full, how can you ensure that the overall progress will not be postponed? If some engineers have no scheduled tasks today Done, how do you solve it?

Comments:
A. Investigate the ability to lead a team;
B. Note that not all questions have very positive and perfect answers. The way of thinking and solving problems is more important than answering the questions themselves.

### From your experience, talk about how to build a high-performance web site? What links are needed? Steps? What needs to be paid attention to in each step, how to optimize, etc.?

Reference prompt points: bandwidth, DNS, CDN, gzip, load balancing and database, etc.

## Technical questions

### Which is faster for or foreach?

Reference answer: http://www.cnblogs.com/niniwzw/archive/2008/06/03/1212535.html

The efficiency of `foreach` is much higher than that of `for`, perhaps a big reason is that `for` requires many conditional judgments. So use `foreach` wherever `foreach` can be used in the future, which can double the efficiency.

If you want to call a function in a loop, it is best to use `array_walk`, its efficiency is twice as high as that of `for`, and it is 43% more efficient than `foreach`.

### What is the difference between PECL and PEAR?

Reference answer: http://jingyan.baidu.com/article/e9fb46e1a3eb277521f76619.html

`PECL (PHP Extension Community Library)` can be seen as an integral part of `PEAR (PHP Extension and Application Repository)`, providing functions similar to `PEAR`. The difference is that all the extensions of `PEAR` are written in pure `PHP` code, users can directly use the extended code after downloading the `PEAR` extension and include it in their own `PHP` file. And `PECL` is developed using `C` language, and it is usually used to supplement some low-level functions that are difficult to complete with `PHP`. It often needs to be recompiled or set in the configuration file before it can be used in the user's own code.

The most direct expression: `PEAR` is the upper layer extension of `PHP`, and `PECL` is the lower layer extension of `PHP`. They all provide ready-made functions or classes for specific applications.

### How to deal with multi-server shared Session?

Reference answer: http://www.toutiao.com/a6294758409293086977/

There are roughly three ways to handle this:

- Database/file synchronization `session`
- `cookie` synchronized with `session`
- cache (like `memcache`) synchronizes `session`

It is recommended to use the last cache synchronization scheme.

### What is Cross Site Scripting? SQL injection?

Cross-site scripting (`XSS`) is a computer security vulnerability, a type of code injection, that typically occurs in web applications. It allows a malicious user to inject code into a webpage, which affects other users viewing the webpage. Such attacks usually involve html and client-side scripting languages. `SQL` injections are security holes that occur at the database layer of an application. If you inject `SQL` instructions into the input characters, and ignore the checks in poorly designed programs, then these injected instructions will be mistaken for normal `SQL` instructions by the database and run, so they will be destroyed.

### Describe the solution for high-traffic and high-concurrency websites

- Confirm whether the server hardware is sufficient to support the current traffic.
- Use `memcache` caching technology to cache dynamic data into files, and dynamic web pages directly call these files without accessing the database.
- Disable external hotlinking. Picture or file hotlinking from external websites often brings a lot of load pressure, so you should strictly limit external picture or file hotlinking to yourself, and you can prevent hotlinking through apache URL redirection.
- Control the download of large files. The download of large files will take up a lot of traffic, which will consume non-SCSI hard disks, making the website's responsiveness lower.
- Use a different host to divert primary traffic.
- Use traffic statistics software. Install a traffic statistics software on the website, you can instantly know which places consume a lot of traffic and which pages need to be optimized.

### PHP memory management mechanism and garbage collection mechanism

Reference answer: http://www.cnblogs.com/zk0533/p/5667122.html

The memory management mechanism of `php` is: give a space in advance to store variables, and apply for a new space when the space is not enough.
1. Store the variable name, and there is a symbol table.
2. The variable value is stored in the memory space.
3. When a variable is deleted, the space for storing the variable value will be released, but the symbol table where the variable name is located will not be reduced.

The `php` garbage collection mechanism is:

1. In version 5.2 or earlier, PHP will judge whether it is garbage according to the reference count (`refcount`) value. If the refcount value is 0, PHP will release it as garbage. This recycling mechanism is flawed. For circular references Variables of cannot be recycled.

2. After version 5.3, the garbage collection mechanism has been improved. details as follows:

If you find that the `refcount` in a `zval` container is increasing, it means it is not garbage;
If it is found that the `refcount` in a `zval` container is decreasing, if it is reduced to 0, it will be garbage collected directly;
If it is found that the `refcount` in a `zval` container is decreasing but not reduced to 0, `PHP` will put the value in the buffer as a suspected object that may be garbage;
When the buffer reaches a critical value, `PHP` will automatically call a method to traverse each value, and clean up if it is found to be garbage.

### Why do you need to separate the database from master to slave?

Reference answer: https://my.oschina.net/candiesyangyang/blog/203425


### What is the difference between multithreading and multiprocessing?

Reference answer: http://www.cnblogs.com/kaituorensheng/p/3603057.html

A process is an execution activity of a program on a computer. When you run a program, you start a process. Obviously, the program is dead (static), and the process is alive (dynamic). Processes can be divided into system processes and user processes. All processes used to complete various functions of the operating system are system processes, and they are the operating system itself in a running state; all processes started by you are user processes. A process is the unit for resource allocation by the operating system. Under `Windows`, processes are subdivided into threads, that is, there are multiple smaller units that can run independently under one process.

### TCP/IP network protocol, what is OSI 7 layer?


Reference answer: http://blog.csdn.net/jenminzhang/article/details/47017741

`TCP/IP` layer 5 refers to:

```
application layer
HTTP, FTP, SMTP, DNS, DSP, Telnet, Gopher, WAIS…
transport layer
TCP, UDP, DVP...
Network layer
IP, ICMP, AKP, RARP, UUCP...
interface layer
Ethernet, Arpanet, PDN...
physical layer
As long as it can transmit IP datagrams (Datagram), any protocol is allowed...
```

`OSI` 7 layers refer to:

```
Application layer File transfer, email, file service, virtual terminal TFTP, HTTP, SNMP, FTP, SMTP, DNS, Telnet
Presentation layer Data formatting, transcoding, data encryption No protocol
Session layer Disassociates or establishes connections with other nodes No protocol
Transport layer provides end-to-end interface TCP, UDP
Network Layer Routing for packets IP, ICMP, RIP, OSPF, BGP, IGMP
Data Link Layer Transmission of addressed frames and error detection functions SLIP, CSLIP, PPP, ARP, RARP, MTU
The physical layer transmits data on physical media in the form of binary data ISO2110, IEEE802, IEEE802.2
```