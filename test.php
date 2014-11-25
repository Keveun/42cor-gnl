<?php
	define("PATH", "files/");
	define("TEST", "test.");
	require "color.php";

	function echo_test($name)
	{
		$colors = new Colors();
		return $colors->getColoredString("\nTEST " . $name . "\n", "light_blue");
	}

	function echo_partie($name)
	{
		$colors = new Colors();
		return $colors->getColoredString("\n---------- PARTIE " . $name . ": ----------\n", "purple");
	}

	function getfile($name, $input = 0)
	{
		$colors = new Colors();
		$path_file = PATH . $name;
		if (file_exists($path_file) && is_file($path_file))
		{
			$exec = ($input) ? "cat " . $path_file . " | ./test_gnl 0 0" : "./test_gnl " . $path_file;
			$s1 = implode(file($path_file, FILE_IGNORE_NEW_LINES));
			exec($exec, $s2);
			$s2 = implode($s2);
			if (!strcmp($s1 , $s2))
				echo $colors->getColoredString("OK\n", "green");
			else
			{
				echo $colors->getColoredString("FAIL\n", "red"); 
				echo "Output should be: <", $s1, ">\nBut is: <", $s2, ">\n";
			}
		}
	}

	function test_fd()
	{
		$colors = new Colors();
		$exec = "./test_gnl 0 0 0";
		$s1 = "-1";
		$s2 = exec($exec);
		if (!strcmp($s1 , $s2))
			echo $colors->getColoredString("OK\n", "green");
		else
		{
			echo $colors->getColoredString("FAIL\n", "red"); 
			echo "Output should be: <", $s1, ">\nBut is: <", $s2, ">\n";
		}
	}
	
	$colors = new Colors();
	echo $colors->getColoredString("\n---------- COMPILATION ---------\n", "yellow");
	exec("make re");
	echo $colors->getColoredString("\nCompilation terminee.\n", "green");
	echo echo_partie("1");
	echo echo_test("1.1");
	echo "1 ligne de 8 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "1", 1);
	echo echo_test("1.2");
	echo "2 lignes de 8 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "2", 1);
	echo echo_test("1.3");
	echo "X lignes de 8 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "3", 1);
	echo echo_test("2.1");
	echo "1 ligne de 8 caracteres avec \\n:\n", getfile(TEST . "1");
	echo echo_test("2.2");
	echo "2 lignes de 8 caracteres avec \\n:\n", getfile(TEST . "2");
	echo echo_test("2.3");
	echo "X lignes de 8 caracteres avec \\n:\n", getfile(TEST . "3");
	echo "\n";

	echo echo_partie("2");
	echo echo_test("1.1");
	echo "1 ligne de 16 caracteres avec \\n:\n", getfile(TEST . "4");
	echo echo_test("1.2");
	echo "2 lignes de 16 caracteres avec \\n:\n", getfile(TEST . "5");
	echo echo_test("1.3");
	echo "X lignes de 16 caracteres avec \\n:\n", getfile(TEST . "6");
	echo echo_test("2.1");
	echo "1 ligne de 16 caracteres avec \\n depuis l'entree standard::\n", getfile(TEST . "4", 1);
	echo echo_test("2.2");
	echo "2 lignes de 16 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "5", 1);
	echo echo_test("2.3");
	echo "X lignes de 16 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "6", 1);
	echo "\n";

	echo echo_partie("3");
	echo echo_test("1.1");
	echo "1 ligne de 4 caracteres avec \\n:\n", getfile(TEST . "7");
	echo echo_test("1.2");
	echo "2 lignes de 4 caracteres avec \\n:\n", getfile(TEST . "8");
	echo echo_test("1.3");
	echo "X lignes de 4 caracteres avec \\n:\n", getfile(TEST . "9");
	echo echo_test("2.1");
	echo "1 ligne de 4 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "7", 1);
	echo echo_test("2.2");
	echo "2 lignes de 4 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "8", 1);
	echo echo_test("2.3");
	echo "X lignes de 4 caracteres avec \\n depuis l'entree standard:\n", getfile(TEST . "9", 1);
	echo "\n";

	echo echo_partie("4");
	echo echo_test("1.1");
	echo "1 ligne de 4 caracteres sans \\n:\n", getfile(TEST . "10");
	echo echo_test("1.2");
	echo "1 ligne de 8 caracteres sans \\n:\n", getfile(TEST . "11");
	echo echo_test("1.3");
	echo "1 ligne de 16 caracteres sans \\n:\n", getfile(TEST . "12");
	echo echo_test("2.1");
	echo "Fichier vide avec \\n:\n", getfile(TEST . "13");
	echo echo_test("2.1");
	echo "Fichier vide avec \\n depuis l'entree standard:\n", getfile(TEST . "13", 1);
	echo "\n";

	echo echo_partie("5");
	echo echo_test("1.1");
	echo "Tester avec un faux file descriptor:\n", test_fd();
	echo "\n";
?>
