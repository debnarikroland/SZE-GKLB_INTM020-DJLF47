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

long previousMillis = 0;
unsigned long currentMillis = 0;
long interval = 250000; 
int t = 0;
int h = 0;
String data;
String erzekeles = "";
String homerseklet = "";
String paratartalom = "";
int i = 0;
String url = "";
boolean kiolvas = true;
boolean hall = false;
String html = "";
int val;
int iState;


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
if(i < 15)
  {
    Serial.println("I erteke: " + i);
    val = digitalRead(30);
    if(val == HIGH)
    {
      i = 49;
      val = LOW;
    }
    if (html.indexOf("nochange") < 0)
    {
      if(html.indexOf("hall:on") > 0)
      {
        digitalWrite(24, HIGH);
      }
      else
      {
        digitalWrite(24,LOW);
      }
      
      if(html.indexOf("kitchen:on") > 0)
      {
        digitalWrite(26, HIGH);
      }
      else
      {
        digitalWrite(26,LOW);
      }
    
      if(html.indexOf("bathroom:on") > 0)
      {
        digitalWrite(28, HIGH);
      }
      else
      {
        digitalWrite(28,LOW);
      }
    }
    
    url ="GET /API/read.php HTTP/1.1";
    httpRequestHomerseklet();
    
    delay(500);
    i++;
  }
  else if (i == 50)
  {
    url = "POST /API/add.php?temp1=0&hum1=0&move=1 HTTP/1.1";
      httpRequestHomerseklet();
    i = 0;
  }
  else
  {
    homerseklet = "";
    paratartalom = "";
  
    h = (int) dht.readHumidity();
    t = (int) dht.readTemperature();
    
    homerseklet = String(t);
    paratartalom = String(h);
    url = "POST /API/add.php?temp1=" + homerseklet + "&hum1=" + paratartalom + "&move=0 HTTP/1.1";
      httpRequestHomerseklet();
    
    i = 0;
  }

}

void httpRequestHomerseklet() {
  client.stop();
    if (client.connect(server, 80)) {
    client.println(url);
    client.println("Host: www.gklb.intm020.debnarik.com");
    client.println("User-Agent: arduino-ethernet");
    client.println("Connection: close");
    client.println();
    

    lastConnectionTime = millis();
  } else {
    Serial.println("connection failed");
    void(* resetFunc) (void) = 0;
  }
}
