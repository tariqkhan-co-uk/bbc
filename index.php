<?php
################################################################################
# FOOD AND RECIPE APPLICATION TO HELP USERS BECOME BETTER AT COOKING           #
################################################################################
# I will not be using frameworks as I beieve this would add bloat to an        #
# aplication as simple as this. A lightweight application would run faster and #
# would offer greater scalability.                                             #
################################################################################

// Define server root as a constant
define('ROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Every site will need a configuration file at some point
require_once(ROOT.'inc/config.php');

// Database
/*
I would usually create a mySQL database and database object to handle db connection, queries, inserts, data sanitisation, etc.
As there is only 3 records and no requirement to add or manipulate this data; I am going retrieve data from an XML file: recipes.xml
It is good practice for records to have a unique key to indentify it by, therfore I have included id as additional data for each record
*/
$db = new Database('recipes');

// Star... I would call it favourit?
$star = new Star($db->data);

// Load requested page
/*
I would normally use .htaccess to implement friendly urls and directing every request to index php for the application to handle page requests
The method below would make it easier for you to deploy my code anywhere on a server or a machine running wamp/mamp with no configuration
*/
if(!empty($_GET['page'])) {
	$page = $_GET['page'];
	switch($page) {
		case 'filter': // Filter recipes
			$filter = new DataFilter($db->data);
			break;
		case 'list': // Recipe list
			$list = new DataList($db->data);
			break;
		case 'item': // Recipe detail
			$item = new DataItem($db->data);
			break;
		case 'starred': // Starred recipes
			break;
		default:
			unset($page);
	}
}
/*
My HTML skills are 100% supporting all (including older) browsers
I have barely commented in the CSS files, but I keep myself up to date with all the latest CSS features; responsive, transitions, etc.
HTML/CSS is what I do best; give me a design (however complex) and I'll create it with no markup errors, supporting all browsers and devices satisfying accessibility to a high level
PLEASE NOTE: I have not cross-browser checked this website and have developed it in FireFox (no time and UI is quite simple)
PHP is also another of my stronger skills, therefore I have barely used javascript
I am primarily a jQuery coder and have included my "back to top" plugin. My portfolio contains a link to other jQuery plugins I have created and is available on GitHub
You can view my website and portfolio to get an understanding of my front-end skills, although quite outdated (no time for maintnance)
I have concentrated on completing all requirements to ensure a fully functional website; no time to improve usability
inc folder contains the main workings of the site and feature folder is mainly for markup
I have setup my own server at home (Apache/mySQL/postfix) on a raspberry pi and have documented how to do this: http://www.tariqkhan.co.uk/articles/
Although havent used a database/htaccess file; the above articles and my personal website proves I can
This site has been built using the easiest methods possible, but not using frameworks and so code is self explanatory, but have commented anyway.
Using frameworks would have required me to differentiate my code from framework code.
*/
?>
<!doctype html>
<html lang="en-gb">
<head>
	<meta charset="utf-8">
	<title>Food &amp; Recipe | Become better at cooking</title>
	<!--[if ie]><meta http-equiv="imagetoolbar" content="no" /><![endif]-->
	<meta name="author" content="Tariq Khan | www.tariqkhan.co.uk">
	<meta name="description" content="Become better at cooking using our Food and Recipe application.">
	<meta name="robots" content="index,follow,noodp">
	<meta name="googlebot" content="noodp">
	<meta name="revisit-after" content="30 days">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Food &amp; Recipe">
	<meta name="application-name" content="Food &amp; Recipe">
	<link rel="stylesheet" type="text/css" media="all" href="style.css">
</head>
<body class="<?php echo isset($page) ? $page : 'home'; ?>">
	<div id="top">
		<div class="bbc">
			<img src="images/bbc.png" alt="BBC">
		</div>
		<nav>
			<div class="skiplinks">
				<h2 class="access">Accessibility</h2>
				<ul>
					<li><a href="#content">Skip to content</a></li>
					<li><a href="#navigation">Main site navigation</a></li>
				</ul>
			</div>
		</nav>
		<div id="header" class="header clr">
			<header>
				<a href="/" title="Homepage" class="logo">Food &amp; Recipe</a>
			</header>
			<div id="navigation" class="navigation" role="navigation">
				<p class="access">Navigation:</p>
				<nav>
					<ul>
						<li><a href="?page=list">Recipe list</a></li>
						<li><a href="?page=filter">Filter recipes</a></li>
						<li><a href="?page=starred">Starred recipes</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div id="content" class="content">
			<section>
				<?php
				if(isset($page)) {
					require_once('feature/'.$page.'.php');
				} else {
					echo '<h1>Food &amp; Recipe</h1><img src="images/food.png" alt="" />';
				}
				?>
			</section>
		</div>
		<div id="footer">
			<footer>
				<p class="copy">Copyright &copy; 2015 BBC.</p>
				<nav>
					<p class="toplink"><a href="#top">Top</a></p>
				</nav>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>
