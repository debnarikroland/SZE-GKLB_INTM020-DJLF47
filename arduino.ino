/*
 * Debnárik Roland József
 * Széchenyi István Egyetem
 * Mikorelektromechanikai rendszerek
 * GKLB_INTM020
 * Távoli megfigyelés és vezérlés
 */


/*Könyvtárak*/
#include <DHT.h>
#include <SPI.h>
#include <Ethernet.h>
/*----------*/

/*MAC, IP és komminukációs szerver beállítása*/
byte mac[] = {  0xAA, 0xBB, 0xCC, 0xDD, 0xEE, 0xAB};
IPAddress ip(192, 168, 137, 200);
IPAddress myDns(192, 168, 137, 1);
char server[] = "www.gklb.intm020.debnarik.com";
EthernetClient client;
/*---------------------------------------------*/

/*Webserveres kérések között eltelt időre változók definiálása*/
unsigned long lastConnectionTime = 0;           // last time you connected to the server, in milliseconds
const unsigned long postingInterval = 10*1000;  // delay between updates, in milliseconds
/*---------------------------------------------------------------*/

/*DH11-es PIN megdasá és hőmérő típus megadása*/
#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);
/*-------------------------------------------*/
/*Változók*/
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
int hallLed = 24;
int kitchen = 26;
int bathroom = 28;
int bedroom = 30;
int pirSensor = 32;
/*-------*/


void setup() {

dht.begin(); 
h = (int) dht.readHumidity(); 
t = (int) dht.readTemperature(); 
String data = "";
/// SD kártya letíltása
pinMode(4, OUTPUT);
digitalWrite(4, HIGH);
///------------------------///

pinMode(hallLed, OUTPUT);
pinMode(kitchen, OUTPUT);
pinMode(bathroom, OUTPUT);
pinMode(bedroom, OUTPUT);
pinMode(pirSensor, INPUT);

 /* Serial.begin(9600);
  while (!Serial) {
    ;
  }*/

  Serial.println("Initialize Ethernet with DHCP:");
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    if (Ethernet.hardwareStatus() == EthernetNoHardware) {
      Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
      while (true) {
        delay(1);
      }
    }
    if (Ethernet.linkStatus() == LinkOFF) {
      Serial.println("Ethernet cable is not connected.");
    }
    Ethernet.begin(mac, ip, myDns);
    Serial.print("My IP address: ");
    Serial.println(Ethernet.localIP());
  } else {
    Serial.print("  DHCP assigned IP ");
    Serial.println(Ethernet.localIP());
  }
  delay(8000);

}

void loop() 
{
  if (client.available()) {
    html = "";
    while(client.available())
    {
      char c = client.read();
      html = html + c;
      Serial.print(c);
    }
  }

  if(i < 15)
  {
    Serial.println("I erteke: " + i);
    val = digitalRead(pirSensor);
    if(val == HIGH)
    {
      i = 49;
      val = LOW;
    }
    if (html.indexOf("nochange") < 0)
    {
      if(html.indexOf("hall:on") > 0)
      {
        digitalWrite(hallLed, HIGH);
        Serial.println ("felkapcsolas");
      }
      else
      {
        digitalWrite(hallLed,LOW);
        Serial.println ("lekapcsolas");
      }
      
      if(html.indexOf("kitchen:on") > 0)
      {
        digitalWrite(kitchen, HIGH);
        Serial.println ("felkapcsolas");
      }
      else
      {
        digitalWrite(kitchen,LOW);
        Serial.println ("lekapcsolas");
      }
    
      if(html.indexOf("bathroom:on") > 0)
      {
        digitalWrite(bathroom, HIGH);
        Serial.println ("felkapcsolas");
      }
      else
      {
        digitalWrite(bathroom,LOW);
        Serial.println ("lekapcsolas");
      }

      if(html.indexOf("bedroom:on") > 0)
      {
        digitalWrite(bedroom, HIGH);
        Serial.println ("felkapcsolas");
      }
      else
      {
        digitalWrite(bedroom,LOW);
        Serial.println ("lekapcsolas");
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
    Serial.println("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx");
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

