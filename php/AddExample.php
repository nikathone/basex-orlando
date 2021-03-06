<?php
/*
 * This example shows how new documents can be added.
 *
 * Documentation: https://docs.basex.org/wiki/Clients
 *
 * (C) BaseX Team 2005-12, BSD License
 */
include("BaseXClient.php");

try {

  // create session
  $session = new Session("basex", 1984, "admin", "admin");

  // create new database called "example"
  $session->execute("create db example");
  print $session->info();

  // add document to the "example" database
  $session->add("world/World.xml", "<x>Hello World!</x>");
  print "<br/>".$session->info();

  // add document to the "example" database
  $session->add("Universe.xml", "<x>Hello Universe!</x>");
  print "<br/>".$session->info();

  // run query on the "example" database
  print "<br/>".$session->execute("xquery /");

  // drop the "example" database
  $session->execute("drop db example");

  // close session
  $session->close();

} catch (Exception $e) {
  // print exception
  print $e->getMessage();
}
?>
