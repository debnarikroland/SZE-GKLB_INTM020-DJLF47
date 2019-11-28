#include <DHT.h>
#include <SPI.h>
#include <Ethernet.h>
byte mac[] = {  0xAA, 0xBB, 0xCC, 0xDD, 0xEE, 0xAB};
IPAddress ip(192, 168, 137, 200);
IPAddress myDns(192, 168, 137, 1);
char server[] = "www.gklb.intm020.debnarik.com";
EthernetClient client;

unsigned long lastConnectionTime = 0;
const unsigned long postingInterval = 10*1000;

#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

int t = 0;
int h = 0;


void setup() 
{
dht.begin(); 
h = (int) dht.readHumidity(); 
t = (int) dht.readTemperature(); 
String data = "";
pinMode(4, OUTPUT);
digitalWrite(4, HIGH);
pinMode(24, OUTPUT);
pinMode(26, OUTPUT);
pinMode(28, OUTPUT);
pinMode(30, INPUT);

Serial.println("Initialize Ethernet with DHCP:");
  if (Ethernet.begin(mac) == 0) 
  {
    Serial.println("Failed to configure Ethernet using DHCP");
    if (Ethernet.hardwareStatus() == EthernetNoHardware) 
	{
      Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
      while (true) 
	  {
        delay(1);
      }
    }
    if (Ethernet.linkStatus() == LinkOFF) 
	{
      Serial.println("Ethernet cable is not connected.");
    }
    Ethernet.begin(mac, ip, myDns);
    Serial.print("My IP address: ");
    Serial.println(Ethernet.localIP());
  } 
  else 
  {
    Serial.print("  DHCP assigned IP ");
    Serial.println(Ethernet.localIP());
  }
  delay(8000);
}

void loop() 
{


}
