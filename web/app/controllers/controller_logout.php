<?php

class Controller_Logout extends Controller
{

	function action_index()
	{	
		unset($_SESSION["user"]);
		session_destroy();
		header("Location: /");
		return true;
	}
}