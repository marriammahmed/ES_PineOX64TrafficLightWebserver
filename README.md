<h1>Building Traffic Light Webserver on Pineox64</h1>

<h2>Projects Description</h2>
The Ox64 is a RISC-V based single-board computer based on the Bouffalo Lab BL808 RISC-V SoC with C906 64-bit and E907/E902 32-bit CPU cores supported by 64 MB of embedded PSRAM memory, and with built-in WiFi, Bluetooh and Zigbee radio interfaces
<br />
<br />
The final project consisted of two parts:  
1. <b>Custom OS Development</b> — built with Buildroot for Pine Ox64, demonstrating OS fundamentals in an embedded environment.  
2. <b>Traffic Light Web Server</b> — controlled GPIO pins for traffic light simulation. Initially designed with Raspberry Pi + Apache but finalized using JavaScript for onboard control. 
The traffic light server was initially implemented with Raspberry Pi + Apache to control GPIO pins but was later replaced with a <b>JavaScript solution</b> to manage the onboard traffic light system.  
<br />

<h2>Project Detail Guideline</h2>
1. Configure Buildroot & cross-compilation toolchain for Pine Ox64.  <br />
2. Build minimal Linux-based OS image.  <br />
3. Flash image and test on Pine Ox64.  <br />
4. Implement GPIO control logic for traffic lights.  <br />
5. Deploy traffic light control server (attempted Apache, finalized JS control).  <br />
6. Validate traffic light operations and system response.  
<br />
<img src="https://i.imgur.com/HzvZLkv.png" height="80%" width="80%" alt="Traffic Light Setup"/>

<h2>Project Demo (Video)</h2>

📹 Watch the demo here: <video src="ES_PineOX64TrafficLightWebserver/final_demo.mp4" controls width="600"></video>


<h2>Languages,Environments and Utilities Used</h2>

- <b>C</b> (low-level programming)  
- <b>Buildroot</b>  
- <b>JavaScript</b> (traffic light control)
- <b>HTML & CSS</b>
- <b>Apache HTTP Server</b> (initial attempt)  
- <b>Pine Ox64 Board</b>  
- <b>Raspberry Pi</b>
- <b>BalenaEtcher</b>
- <b>Bouffalo Lab</b> 
- <b>Linux Buildroot Environment</b>  


<h2>Course Outcomes</h2>

- Programmed microcontrollers; interfaced sensors, actuators  
- Low-level C programming, memory-constrained environments  
- Basics of real-time operating systems (RTOS)  
- Designed hardware-software integration for automation systems  
<br />

<h2>Program Walk-through (Photos)</h2>

<p align="center">
Traffic light hardware setup: <br/>
<img src="https://i.imgur.com/fsaO9b1.jpeg" height="80%" width="80%" alt="Traffic Light Setup"/>
<br />
<br />
Web server interface: <br/>
<img src="https://i.imgur.com/cdpdPFT.jpeg" height="80%" width="80%" alt="Apache Interface"/>
<br />
<br />
JavaScript control panel (final implementation): <br/>
<img src="https://i.imgur.com/C01eIqe.jpeg" height="80%" width="80%" alt="JS Traffic Light"/>
<br />
<br />
</p>
