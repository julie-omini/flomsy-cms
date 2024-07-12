<?php
//////////////
// Function //
//////////////
//Random code
echo CMS->Function->RandomCode();
echo '<br>';
//Random string
echo CMS->Function->RandomString();
echo '<br>';

//////////////
//  Members //
//////////////
//Register(email, pseudo, password, nom = null, prenom = null, adress = null, city = null, postal = null, phone = null);
CMS->Members->Register("aaa@gmail.com", "testttt" ,"vvv"); // True / False
//Login(email, password)
CMS->Members->Login("aaa@gmail.com", "vvv");
//IsConfirmed(email)
CMS->Members->IsConfirmed("aaa@gmail.com"); // True / False
//Confirmed(email, code)
CMS->Members->Confirmed("aaa@gmail.com", "867391540"); // True / False


//////////////
// Security //
//////////////
//Include(path);
//CMS->Security->Include("teste.php");

/////////////
// Session //
/////////////
// role
CMS->Session->GetRole(); //Int 0 = visitor, 1 = membre, 2 = moderateur, 3 = admin
// Destroy
CMS->Session->Destroy(); // Destroy the session
// Get $_SESSION['Email']
CMS->Session->Get("email");


/////////
// Log //
/////////
//Report(array("File", "Message"))
//CMS->Log->Report(["File" => __FILE__, "Message" => "Exemple log report"]);

//////////////
// DataBase //
//////////////
// execute and fetch key Name
CMS->DataBase->execute("SELECT * FROM `template` WHERE `Enable` = true")->fetch("Name");
// execute and fetch row
CMS->DataBase->execute("SELECT * FROM `template` WHERE `Enable` = true")->fetch();
//execute vérifie que le execute c'est pas effectué
CMS->DataBase->execute("SELECT * FROM `template` WHERE `Enable` = true")->Success;
// execute
CMS->DataBase->execute("SELECT * FROM `template` WHERE `Enable` = true");
// execute and fetchall row 0
CMS->DataBase->execute("SELECT * FROM `template` WHERE `Enable` = true")->fetchAll(0);
// execute and fetchall
CMS->DataBase->execute("SELECT * FROM `template` WHERE `Enable` = true")->fetchAll();

//Plugins->{Name Plugin}
CMS->Plugins->Exemple->teste();