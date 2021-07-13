<?php
  include("../view/session_start.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
		<meta name="viewport" content="width=device-width, intial-scale=1.0">
	</head>
	<body>
		<?php include_once("../view/navbar.php"); ?>

		<div class="container">
					<h3>Week 1</h3>
					<p>The grid system in Bootstrap breaks down the web page into columns and rows with a maximum of twelve columns across the width of the page.
						This is useful for displaying and organising content. It also allows columns and rows within columns which further improves the simplicity of managing content.</p>
					<p>This week I used this feature by creating a three by four grid of Bootstrap cards. Each card contains the logo of a basketball team along with its title and description below it.
					Another useful aspect of the grid system is its ability to adapt to certain screen sizes depending on the class used which makes the website responsive.</p>
					<p>I will implement menus using the Bootstrap navigation bar. Each week will include a dropdown menu which links to the commentary of that specific week. 
					The navigation bar also adapts by turning into a hamburger menu which is a useful attribute for removing clutter on smaller screen sizes.</p>
					<p>Forms will be useful for user registration, user login and adding comments to articles.</p>
					<p>Screen reader classes will be useful for displaying elements only for screen readers, eliminating the need to read through insignificant contents. </p>
					<p>Pagination is useful for going back to older articles. This will create better spacing and reduce the compression of multiple articles in one page.</p>
					<p>Navs will be useful for building the navigation components. I can use it for highlighting the current page the user is on. It can also be used for navigation inside the user profile.</p>
				
					<h3>Week 2</h3>
					<p><strong>Items</strong> table stores all of the item names and descriptions.</p>
					<p><strong>Images</strong> table stores all of the images using it's image path as plain text and the image title.</p>
					<ul>
						<li><strong>Item Images</strong> table stores the the images used by a specific item using the item ID and the image ID.</li>
						<li><strong>Article Images</strong> table stores the the images used by a specific article using the article ID and the image ID.</li>
					</ul>
					<p><strong>Articles</strong> table stores all of the article information such as ID, author, title, text, and the item ID to identify which item it belongs to.</p>
					<p><strong>Users</strong> table stores all of the usernames and password.</p>
					<p><strong>Comments</strong> table stores all of the comments, user ID, and article ID to identify who the comment belongs to and to which article.</p>
					<h5>Entity Relationship Diagram</h5>
					<p><img class="img-fluid" src="images/ERD.jpg" style="height:650px;width:650px;"></p>
					<h5>Issues</h5>
					<p>I had to create artificial tables to represent relationships for both item and article to record which item or article uses the image.</p>
					<p>Normalisation is a must to ensure all insert, update, and deletion anomalies are eliminated because tables are joined to get accurate query results.</p>
					
					<h3>Week 3</h3>
					<code>
					function get_article($item_id) <br>
					{ </br>
						&nbsp;&nbsp;global $conn; <br>
						&nbsp;&nbsp;$stmt = mysqli_stmt_init($conn); <br>
						&nbsp;&nbsp;$sql = "SELECT articles.article_title, articles.article_author, articles.article_text, images.image_path, images.image_title <br>
						&nbsp;&nbsp;FROM articles, images INNER JOIN article_images <br>
						&nbsp;&nbsp;WHERE articles.article_id = article_images.article_id AND images.image_id = article_images.image_id AND articles.item_id = ?"; <br>
						&nbsp;&nbsp;mysqli_stmt_prepare($stmt, $sql); <br>
						&nbsp;&nbsp;mysqli_stmt_bind_param($stmt, 's', $item_id); <br>
						&nbsp;&nbsp;mysqli_stmt_execute($stmt); <br>
						&nbsp;&nbsp;$result = mysqli_stmt_get_result($stmt); <br>
						&nbsp;&nbsp;$row = mysqli_fetch_array($result); <br>
						&nbsp;&nbsp;return json_encode($row); <br>
					}
				</code>
					<p>This method is used for retrieving an item's article from the database and the image associated with the article.</p>
					<p>It expects an item identification as a parameter which will be used as the condition value within the query. Specifying the item ID enables
						the query to display only the article associated with the item. The query result is stored in a variable which is then encoded into JSON format before it is returned to where the method was called.</p>
					<p><img class="img-fluid" src="images/week3-commentary.jpg"></p>
					<p>I call this method within the view code where I'm displaying the article for the chosen item. I used a GET request to get the value of the item which is sent as 
						an argument to the get_article() method of the API.
					</p>

					<h3>Week 4</h3>
					<p>The only security measure I have implemented to protect the comment section is by changing its visibility. Only users that are logged in are able to see the comment form.</p>
					<p>The current security of the website is insufficient for an e-commerce website. It lacks protection from SQL injection making it vulnerable to SQL queries that could modify tables or 
						delete the whole database. It also has no preventative measures for cross-site scripting attacks resulting in not only the exploitation of the website but also the users themselves. Sensitive and personal 
						information used by the browser and the website are accessible by the malicious script. The HTML content can also be rewritten by the script. It is a major security flaw which could cause serious damage for both website and end users.</p>
					<p>Regarding the storage of sensitive information such as credit cards, it would be best to use a third party such as PayPal, Sage, or Stripe. These are large companies that specialise in secure transactions and protected storage of millions of users 
						payment details. The username for the website can be figured out easily by other students as it is available publicly. If the website were to sell items, enforce that usernames and passwords are changed frequently to something complex. It is also 
						an additional layer of security to store the user's IP address if a login attempt is unsuccessful, blocking the IP address after a few attempts.</p>
					<strong>Set session maximum length to 5 minutes</strong>
					<code> $session_duration = 300;<br></code>
					<p>Firstly, I create a variable that stores the maximum length of the session in seconds. In this case it's 300 seconds which is 5 minutes.</p>
					<code>
						if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_duration) <br>
						{ <br>
							&nbsp;&nbsp;session_unset();<br>
							&nbsp;&nbsp;session_destroy();<br>
							&nbsp;&nbsp;header("location: ../view/login.php?session_expired=1");<br>
						}<br>
					</code>
					<p>Secondly, I create an if statement with two conditions. It checks if the session has been set. This uses the <code>isset()</code> function. The other condition checks if the current server time (using the <code>time()</code> function) minus the last activity time is 
					greater than the session duration. If both conditions are true, it unsets and detroys the session redirecting the user back to the login page.</p>
					<code>$_SESSION['last_activity'] = time();</code>
					<p>Lastly, create a session to store the time of last activity using the <code>time()</code> function. The if statement above will not run unless this session has been set so it is important to set it last.</p>
					
					<h3>Week 5</h3>
					<strong>Front-End</strong>
					<p>For each field in the form, I specified the input type required e.g. email type for email and text type for names. Adding an extra layer to this, I included the pattern attribute which uses regular expressions to filter the user input.</p>
					<p><img class="img-fluid" src="images/week5-commentary-pattern.jpg"></p>
					<p>As displayed above, the password field uses the pattern attribute which uses a regular expression that ensures the field data must have a lowercase letter, an uppercase letter, a number, and a special character. This is also used on the other data fields with slight changes on the pattern that suits the expected input.</p>
					<strong>Back-End</strong>
					<p><img class="img-fluid" src="images/week5-commentary-controller.jpg"></p>
					<p>Each data that is passed through to the controller is sent as an argument to the functions <code>clean_data()</code> and <code>clean_pw()</code> to remove characters that may be used for SQL injections.</p>
					<p><img class="img-fluid" src="images/week5-commentary-function.jpg"></p>
					<p>The function <code>clean_data()</code> uses the <code>stripslashes()</code> to remove the slashes then <code>strip_tags()</code> to remove HTML and PHP tags and lastly <code>mysqli_real_escape_string()</code> to escape strings special characters.</p>
					<p>The second function <code>clean_pw()</code> is the same as <code>clean_data()</code> without<code>stripslashes()</code> because passwords may have slashes as special characters.</p>
					<p><img class="img-fluid" src="images/week5-commentary-parameter.jpg"></p>
					<p>For the SQL queries, I bound the parameters to further prevent SQL injections as doing this would also escape the strings.</p>
					<strong>Weak Security</strong>
					<p>The website has predictable file systems. Each page is named accordingly which may make it easier for hackers to guess or identify pages that may or may not be meant for public viewing.</p>
					<p>Google reCaptcha is not implemented within the registration form. This is an issue if a user attempts to abuse the registration form by sending automated requests to create hundreds if not thousands of accounts.</p>
					<strong>Good Security</strong>
					<p>Users are enforced to have a minimum of eight characters in their password which includes at least one uppercase letter, one lowercase letter, a number, and a special character. Hackers that may steal passwords will have a difficult time guessing these passwords. Along with these, the passwords are also hashed and salted. Decrypting them is almost impossible.</p>
					<p>Users are required to tick the Google reCaptcha in order to login.</p>
					<p>Only logged in users are able to comment on an article. The comment box is not visible to the user unless they are logged in as it requires the user's ID to add the comment to the database.</p>
					
					<h3>Week 6</h3>
					<p>The aim of an MVC Framework is to separate the concerns of an application into three main logical components to create a scalable project. Each of these components are built to handle specific development aspects of the application. This also creates a structured environment for the code-base as each components clearly identify the front-end from the back-end instead of 
					combining them altogether in a single directory or file.</p>
					<p>The MVC Framework has multiple advantages that clearly benefits the development and the developers. Development process is faster as there can be multiple people working on the different components of the application simultaneously which also makes it easier to collaborate. It allows for a scalable project as adapting to changes and updating the application are easier because it forces the user to create methods for performing specific operations. 
					It also makes debugging easier as there are multiple levels properly written in the application.</p>
					<p>When writing the code for part 3, I needed to know the link for the API, the method names, and the JSON objects.</p>
					<p><img class="img-fluid" src="images/week6-commentary-flow.jfif"></p>
					
					<h3>Week 7</h3>
					<p>As shown in the Device Code image, the 4 sensors are read and inside the getTemp() function the values are being defined to produce the correct output.</p>
					<p>I tested the program by printing out the individual readings of each sensor in the console log and then all of them at once. When they are passed to the agent, I also print out the encoded json of the readings to ensure that they are passed correctly. I also checked if temperature.php in the controller is getting the contents from the agent without errors by printing them. Once all of these are working, the last testing is to simply check the database if the readings are being stored.</p>
					<strong>Device Code</strong>
					<p><img class="img-fluid" src="images/week7-commentary-device.JPG"></p>
					<strong>Agent Code</strong>
					<p><img class="img-fluid" src="images/week7-commentary-agent.JPG"></p>
					<strong>PHP Code</strong>
					<p><img class="img-fluid" src="images/week7-commentary-php.JPG"></p>
					<strong>Database</strong>
					<p><img class="img-fluid" src="images/week7-commentary-reading.JPG"></p>

					<h3>Week 8</h3>
					<p><img class="img-fluid" src="images/week8-commentary-diagram.JPG"></p>
					<p>The diagram shows that the electric imp device produces the readings which are then formatted into JSON that is sent to the agent code. The agent encodes this in JSON and uses a POST request to send this to the PHP controller. The PHP controller passes this data to the API and the API executes the query to store the data in the database.</p>
					<p>Storing the data as JSON in one single MySQL Database means that I do not have to define the fields clearly at the beginning. I can adapt to changes easily as I can simply add new keys if I require more fields to record data. The data is indexed by a reading ID, speeding up searches to find specific readings.</p>
					<p><img class="img-fluid" src="images/week8-commentary-db.jpg"></p>
					<p>The program is free from error as the sensors are producing the correct readings and is passed on to the agent without problems. The agent is able to use a POST request to the PHP controller without issues and the controller stores the data in the database using the API without any issues.</p>
					<h3>Week 9</h3>
					<strong>Program 1: Latest Reading</strong>
					<p>The latest reading program grabs the most recent data produced by the electric imp that has been stored in the database. It uses the returned JSON document by the Model/API to display the necessary values.</p>
					<strong>Program 2: Ten Latest Readings</strong>
					<p>The ten latest readings is the same as the basic program above, however this program displays the ten latest readings. When a user refreshes the page or returns at a later time, the readings will change if new data has been read from the electric imp and stored in the database.</p>
					<strong>Program 3: Ten Latest Readings (Auto Update)</strong>
					<p>This program is similar to the program above, however the user does not need to refresh the page to see the most recent readings from the electric imp. It uses AJAX that invokes the API to get the ten latest readings. This AJAX function is then repeated every 20 seconds to match the 20 seconds interval of the electric imp.</p>
					<strong>Program 4: Readings Charts</strong>
					<p>The readings charts uses the Ten Latest Readings program data and Google Charts to visualise the temperature readings, voltage, and light level. </p>
					<p>The use of JQM makes the programs suitable for mobile phones as it adds efficient page loads when a program is selected or simply returning back to the list of programs.</p>

					<h3>Week 10</h3>
					<p>An RSS first requires an &lt;xml&gt; tag that states the XML version. It is then followed by an &lt;rss&gt; tag and its version. Within the &lt;rss&gt; tag is the channel tag to describe the RSS feed and within the &lt;channel&gt; tag is one or more &lt;item&gt; tag that requires three child tags such as &lt;title&gt;, &lt;link&gt;, and &lt;description&gt;.</p>
					<p><img class="img-fluid" src="images/week10-commentary-rss.jpg"></p>
					<p>As shown in the image above, I created my own RSS feed that contains the five latest articles in the website in JSON format. Each essential tags required for an RSS feed has been created using the available functions from the DOMDocument Class and these are appended to their respective parent. A for loop has been used to create each item within the channel and the three child tags required for each item that displays the object literals from the decoded JSON document. The DOMDocument object is then saved and echoed to display the five articles whenever the RSS icon is clicked.</p>
					
					<h3>Week 11</h3>
					<p><img class="img-fluid" src="images/week11-commentary-xsl.JPG"></p>
					<p>It uses cbssports.com's rss feed to display the five latest headlines regarding the NBA. As shown in the image above, I read the external RSS/XML file, the XSLT file "basketball.xsl", and using an XSLT processor I link the data with the XSLT instructions and it is then displayed.</p>
					<p><img class="img-fluid" src="images/week11-commentary-xsl-2.JPG"></p>
					<p>In order to get the necessary information that I need to display I used three apply-templates with their own XPath to get the copyright, description, and the five items. For each item I am displaying the publish date, the headline, and the description.</p>
					<p>One of the main advantages of XSLT is using XPath to locate elements and attributes instead of directly manipulating the DOM myself using PHP. Another advantage is the separation of the data (XML) and the presentation (XSLT) makes changing the ouput format easy without touching the code behind.</p>
					
					<h3>Week 12</h3>
					<p>Within the View component, the user has three REST Web Services to choose from: inserting a new item, getting one specific item, and get all items. The Controller component holds the controls for each individual services using cURL sessions using POST and GET requests. Each controller uses another file that contains the switch statement to invoke methods from the Model depending on the type of request. This file is accessed by the exact URL and the URL is used to initialise the cURL session. Lastly, the Model contains the library of functions that the controller can invoke.</p>
					<p>The REST Web Service is proven to work as inserting a new item returns a success message and that it is clearly added in the database. Getting one specific item by providing the item ID returns only that specific item with that ID and getting all the items displays all the items in the database in JSON format.</p>
					<p>To ensure only accredited users can access the REST Web Service is to implement session checking for displaying and using the services. This would mean that only logged in users can access and use the REST Web Service. Without a valid session it would not be displayed and unusable.</p>
		</div>
		<?php include("../view/footer.html");?>
	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>