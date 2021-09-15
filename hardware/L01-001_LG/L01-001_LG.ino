#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>
#include <WiFiClient.h>

SoftwareSerial ArduinoSerial(D1, D0); // RX | TX

//Set these to your desired credentials.
const char *ssid = "You ssid wifi";
const char *password = "password wifi";

//Web/Server address to read/write from
const char *host = "http://wash-station.herokuapp.com/add.php";

int WTime;
int Mode;
String state;
String WID = "L01-005";
String Model = "WD-14180FDS";
String Location_ID = "L01";

void setup() {

  ArduinoSerial.begin(9600);

  Serial.begin(9600);

  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot

  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP()); //IP address assigned to your ESP
}

void loop() {

  //ส่วน Hardware

  //ส่งข้อมูล mode ให้ arduino
  while (Serial.available() > 0) {
    Mode = Serial.read();
    if ( Mode == '1' || Mode == '2' || Mode == '3' || Mode == '4' || Mode == '5' || Mode == '6' || Mode == '7' || Mode == '8' ) {
      Serial.print(" Mode : ");
      Serial.write(Mode);
      Serial.write("\n");
      ArduinoSerial.print(Mode);
    }
  }

  //รับข้อมูล เวลา และ โพรเสจ จาก Arduino
  while (ArduinoSerial.available()) {
    WTime = ArduinoSerial.read ();
    Serial.print("\nTime is :");
    Serial.println(WTime);
    state = ArduinoSerial.readString();
    Serial.print("State is :");
    Serial.print(state);
    Serial.flush();

    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      WiFiClient client;
      HTTPClient http;

      http.begin(client, host);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      int WTimeData = WTime;
      String getData = "WID=" + WID + "&Model=" + Model + "&Location_ID=" + Location_ID + "&WTime=" + String (WTimeData) + "&State=" + state;

      Serial.print(getData);

      int httpResponseCode = http.POST(getData); //Send the request

      if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      http.end(); //Close connection
    }
    else {
      Serial.println("WiFi Disconnected");
    }
  }
}
