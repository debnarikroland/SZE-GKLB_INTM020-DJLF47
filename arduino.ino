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


void setup() 
{
}

void loop() 
{


}
