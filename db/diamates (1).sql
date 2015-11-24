-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2015 at 04:37 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diamates`
--

-- --------------------------------------------------------

--
-- Table structure for table `config_management`
--

CREATE TABLE IF NOT EXISTS `config_management` (
  `id` double NOT NULL,
  `host_id` double NOT NULL,
  `user_id` double NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_metakeywords` text NOT NULL,
  `page_metadesc` text NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `page_desc` longtext NOT NULL,
  `page_position` enum('t','b','bt') NOT NULL COMMENT 't=top;b=bottom;both',
  `status` enum('y','n') NOT NULL DEFAULT 'y',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `page_parent` double NOT NULL DEFAULT '0',
  `order_number` int(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `user_id`, `page_name`, `page_title`, `page_metakeywords`, `page_metadesc`, `page_url`, `page_desc`, `page_position`, `status`, `created`, `updated`, `ipaddress`, `page_parent`, `order_number`) VALUES
(1, 3, 'aboutus', 'About Us', 'About Us', 'About Us', 'aboutus', '<div class="span12 space-mobile">\r\n<p><b>Company Info</b></p>\r\n\r\n<p>Dimatas Technologies is pioneer in building cloud based software for software and hardware management and security.</p>\r\n\r\n<p>We are guided by a singular vision:</p>\r\n\r\n<p><b>Security + Simplicity = Better Software</b></p>\r\n\r\n<p>We are offering our customers world class Cloud based software for doing this. Our software is designed to be simple, yet elegant.</p>\r\n\r\n<p>It hides all the software complexity with world class intuitive GUI. The GUI look and feel is similar across different device.</p>\r\n\r\n<p>The software deliver gives a simplistic solution to a lingering problem of Security in Cloud</p>\r\n\r\n<p><b><u>Our Products</u></b></p>\r\n\r\n<p><b>&quot;Simply Monitor&quot;</b>: Cloud based agentless monitoring solution</p>\r\n\r\n<p><b>&quot;Simply Port Scanner&quot;</b>: A cloud based IT port scanning software</p>\r\n\r\n<p><b>&quot;Simply Vulnerability Scanner&quot;</b>: A cloud based IT Vulnerability scanner and report generator</p>\r\n</div>\r\n', 'bt', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.7', 0, 2),
(4, 3, 'contactus', 'Contact Us', 'Contact Us', 'Contact Us', 'contactus', '<!-- BEGIN INFO BLOCK -->\r\n<div class="span12 space-mobile">\r\n<h2>Main office</h2>\r\n\r\n<p><strong>Dimatas Technologies</strong><br />\r\n97 Winding Wood Dr, Suite 2B<br />\r\nSayreville, NJ, 08872</p>\r\n\r\n<p>Phone: 917-546-9088</p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:0px;">\r\n<h2>Sales Office</h2>\r\n\r\n<p><strong>Dimatas Technologies</strong><br />\r\n244 5th Ave,<br />\r\nNew York, NY 10001<br />\r\nEmail: <strong><a href="mailto:Sales@dimatas.com">Sales@dimatas.com</a></strong></p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:0px;">\r\n<p>If you&#39;ve looked around our site and still didn&#39;t find the answer to your question, we&#39;d like to help. Best way to reach us is via email or feedback form:&nbsp; <strong><a href="mailto:contactme@dimatas.com">contactme@dimatas.com</a></strong></p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:0px;">\r\n<p>We will like to hear your comments and feedback.</p>\r\n</div>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '155.70.23.45', 1, 0),
(6, 3, 'management', 'Management', 'Management', 'Management', 'management', '<!-- BEGIN INFO BLOCK -->\r\n<div class="span12 space-mobile">\r\n<h2>CEO and Founder: Kama R</h2>\r\n\r\n<p>Kama R has about 15 years of experience in industry. He has worked Software Architect before founding Dimatas Technologies. He is keenly interested in software integration and easy access to data by various devices. Apart from his love for technology, he is keen in designing software that are echo friendly. He has done BE in Electronics and Telecommunication and MS in Computer Science.</p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:0px;">\r\n<h2>Director: Dr P Chau</h2>\r\n\r\n<p>Dr P Chau brings wealth of knowledge about new business incentive and product marketing. Her innovative product knowledge has help Dimatas come with better software for customers.</p>\r\n</div>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123.63.42.74', 1, 0),
(5, 3, 'investorsrelation', 'Investors Relation', 'Investors Relation', 'Investors Relation', 'investors-relation', '<div class="span12 space-mobile">\r\n<p>Dimatas is a financially stable company. We are currently self-financed. We are open to external investment from all around the world as per the US company regulation.If you are interested in investing in Dimatas Technologies and would like to have more information about company and its growth plan, please send your contact information.You can send email at</p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:0px;">\r\n<p><strong><a href="mailto:invest@dimatas.com">invest@dimatas.com</a></strong></p>\r\n</div>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 1, 0),
(7, 3, 'career', 'Career', 'Career', 'Career', 'career', '<!-- BEGIN INFO BLOCK -->\r\n<div class="span12 space-mobile">\r\n<p>Dimatas Technologies is always looking for fresh talent. we look for the following key talent in any person</p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:20px;">\r\n<p>&nbsp;</p>\r\n\r\n<ul style="list-style:disc;">\r\n	<li>Loves new technology</li>\r\n	<li>Feels working with it as opportunity and quickly masters it</li>\r\n	<li>Can think bold and out of box</li>\r\n	<li>And think of making a product that can be used across the globle by different people, culture and language.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div class="span12 space-mobile" style="margin-left:0px;">\r\n<p>And if you have answered yes to all the above,we will love to talk to you. Thanks for you interest in Dimatas Technologies.</p>\r\n\r\n<p>Please send your resume to <a href="mailto:jobs@dimatas.com" target="_blank">jobs@dimatas.com</a></p>\r\n</div>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.1.101', 1, 0),
(8, 3, 'press', 'Press', 'Press', 'Press', 'press', '<div class="span12 space-mobile">\r\n<h2>Sep&nbsp;17,2014</h2>\r\n\r\n<p>Dimatas Release the Beta version of SimplyMonitor. It allows user to monitor their device: Servers, routers, printer from the cloud. User can configure their device monitoring without doing any changes in their device. All device are monitored from our cloud based SimplyMonitor server.</p>\r\n\r\n<h2>Aug&nbsp;1,2015</h2>\r\n\r\n<p>Dimatas Releases Beta version of Simply Port Monitor and Simply Port Scanner for the Small and medium business. These products are all based on industry standard open stack products.</p>\r\n</div>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.1.101', 1, 0),
(9, 3, 'simplymonitor', 'Simply Monitor', 'Simply Monitor', 'Simply Monitor', 'simply-monitor', '<p>â€‹</p>\r\n\r\n<div class="span12">\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<p><b>Simply Monitor</b> is a Cloud based IT infrastructure monitoring software .Simply Monitor is computers and networking monitoring tool that helps user( individual or enterprise) to manage availability, Performance and utilization of the infrastructure. Its simple cloud based design enables user get all the monitoring done very easily.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h2>Features of <b>Simply Monitor</b></h2>\r\n\r\n<p>This product allows user to seamlessly monitor their operating system like windows, Linux, Solaris, OpenBSD and network devices like Switches, Routers etc.</p>\r\n\r\n<p>Simply Monitor is cloud based solution that DOES NOT REQUIRE USER TO INSTALL ANY SOFTWARE. All software configurations are done on our side which is a simple GUI based frontend.</p>\r\n\r\n<p>Simply Monitor allows to check some of the key parameters like :</p>\r\n\r\n<ul>\r\n	<li>Availability</li>\r\n	<li>Performance</li>\r\n	<li>Utilization</li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h2>Technology behind Simply Monitor:</h2>\r\n\r\n<p>Nagios /ËˆnÉ‘ËÉ¡iËoÊŠs/, an open-source computer-software application, monitors systems, networks and infrastructure. Nagios offers monitoring and alerting services for servers, switches, applications and services. It alerts users when things go wrong and alerts them a second time when a the problem has been resolved.</p>\r\n\r\n<p>Ethan Galstad and a group of developers originally wrote Nagios as NetSaint. As of 2015 they actively maintain both the official and unofficial plugins. Nagios is a recursive acronym: &quot;NagiosAin&#39;tGonna Insist On Sainthood&quot;[3] - &quot;sainthood&quot; makes reference to the original name NetSaint, which changed in response to a legal challenge by owners of a similar trademark.[4] &quot;Agios&quot; (or &quot;hagios&quot;) also transliterates the Greek word Î¬&gamma;&iota;&omicron;&sigmaf;, which means &quot;saint&quot;.</p>\r\n\r\n<p>Nagios was originally designed to run under Linux, but it also runs well on other Unix variants. It is free softwarelicensed under the terms of the GNU General Public License version 2 as published by the Free Software Foundation.</p>\r\n\r\n<p>(The above Content taken from Wikipedia)</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid margin-bottom-20">\r\n<div class="span6">\r\n<ul>\r\n	<li>We have designed our monitoring stack using the world&rsquo;s best open source monitoring tool called Nagios.</li>\r\n	<li>We have designed our infrastructure using open source LAMP stack with tight integration of lots of open source API.</li>\r\n	<li>We have further enormous energy for tight and seamless functioning of all these technologies for ease of use</li>\r\n</ul>\r\n\r\n<h3>Easy Steps to use Simply Monitor</h3>\r\n\r\n<p>The use of Simply Monitor is simple and easy</p>\r\n\r\n<ul>\r\n	<li>Step1: Create your login or user facebook or Google Login</li>\r\n	<li>Step2: Add your host: you can use either website name or server IP address</li>\r\n	<li>Step3: Click on services that you want to monitor for that host</li>\r\n	<li>Step4: Click complete</li>\r\n	<li>Step5: Nothing to do. You servers are getting monitored by World class software and infrastructure.</li>\r\n</ul>\r\n</div>\r\n\r\n<div class="span6"><img src="http://dimatas.com/assests/site/img/simplymoniter.png" /></div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<h2>Detail Services information for reference for Simply Monitor</h2>\r\n<style type="text/css">.table-advance thead tr th {\r\n											background-color: #0da3e2;\r\n											font-size: 14px;\r\n											font-weight: 400;\r\n											color: #fff;\r\n										}\r\n										.table-advance thead tr td{\r\n											text-align: center;\r\n										}\r\n</style>\r\n<table class="table table-striped table-bordered table-advance table-hover">\r\n	<thead>\r\n		<tr>\r\n			<th>\r\n			<p>Service Name</p>\r\n			</th>\r\n			<th>\r\n			<p>Default Port</p>\r\n			</th>\r\n			<th>\r\n			<p>Port Function</p>\r\n			</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>check_ftp</p>\r\n			</td>\r\n			<td>\r\n			<p>21</p>\r\n			</td>\r\n			<td>\r\n			<p>FTP Port</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_http</p>\r\n			</td>\r\n			<td>\r\n			<p>80,443</p>\r\n			</td>\r\n			<td>\r\n			<p>HTTP website&nbsp; port check</p>\r\n\r\n			<p>This plugin tests the HTTP service on the specified host. It can test normal (http) and secure (https) servers, follow redirects, search for strings and regular expressions, check connection times, and report on certificate expiration times</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_ping</p>\r\n			</td>\r\n			<td>\r\n			<p>7</p>\r\n			</td>\r\n			<td>\r\n			<p>Use ping to check connection statistics for a remote host.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_Pop</p>\r\n			</td>\r\n			<td>\r\n			<p>109/110</p>\r\n			</td>\r\n			<td>\r\n			<p>This plugin tests POP connections with the specified host (or unix socket).</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_smtp</p>\r\n			</td>\r\n			<td>\r\n			<p>25</p>\r\n			</td>\r\n			<td>\r\n			<p>Mail software status check This plugin will attempt to open an SMTP connection with the host.</p>\r\n\r\n			<p>Port number (default: 25)</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_snmp</p>\r\n			</td>\r\n			<td>\r\n			<p>161</p>\r\n			</td>\r\n			<td>\r\n			<p>Check status of remote machines and obtain system information via SNMP Port number (default: 161)</p>\r\n\r\n			<p>SNMP communication (default is &quot;public&quot;)</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_ssh</p>\r\n			</td>\r\n			<td>\r\n			<p>22</p>\r\n			</td>\r\n			<td>\r\n			<p>Try to connect to an SSH server at specified server and port</p>\r\n\r\n			<p>Port number (default: 22)</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Check TCP</p>\r\n			</td>\r\n			<td>\r\n			<p>Any port as defined by user</p>\r\n			</td>\r\n			<td>\r\n			<p>This checks the TCP port service availability for the defined port. Multiple port can be checked by putting the values separated by comma( Example: 123, 153,191)</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Check UDP</p>\r\n			</td>\r\n			<td>\r\n			<p>Any port as defined by user</p>\r\n			</td>\r\n			<td>\r\n			<p>This checks the UDP port service availability for the defined port. Multiple port can be checked by putting the values separated by comma( Example: 123, 153,191)</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>check_nt</p>\r\n			</td>\r\n			<td>\r\n			<p>1248</p>\r\n			</td>\r\n			<td>\r\n			<p>This plugin collects data from the NSClient service running on a Windows NT/2000/XP/2003/2012 server.</p>\r\n\r\n			<p><b>Notes</b>: The NSClient service should be running on the server to get any information (<a href="http://nsclient.ready2run.nl/">http://nsclient.ready2run.nl</a>).</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n', 'bt', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.2', 20, 0),
(18, 3, 'itconsultingservices', 'IT Consulting Services', 'IT Consulting Services', 'IT Consulting Services', 'consulting-services', '<p>â€‹</p>\r\n\r\n<div class="row-fluid ">\r\n<div class="span12 space-mobile">\r\n<h2>Website Security Consulting &amp; Professional services</h2>\r\n\r\n<p>We offer our comprehensive Site Security reporting for small to medium business. The services give our customers comprehensive look at the site from outside prospective. We give our customer peace of mind in security.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h2>What are the data point we offer in security services?</h2>\r\n\r\n<p>The services give our customer a comprehensive look at the site from outside prospective with respect to</p>\r\n\r\n<ul>\r\n	<li>Ports</li>\r\n	<li>Uptime</li>\r\n	<li>Services</li>\r\n	<li>Vulnerability report and site risks</li>\r\n	<li>Small and Medium Business sites Cyber Security guidelines (Coming soon)</li>\r\n	<li>Small and Medium Business risk assessment (Coming soon)</li>\r\n	<li>Small Medium Business Risk remediation (Coming soon)</li>\r\n	<li>Website Content change( Coming soon)</li>\r\n	<li>SSL certificate validity ( Coming soon)</li>\r\n	<li>And Much More</li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h2>Type of services our customer can buy:</h2>\r\n\r\n<p>The service is offered in these services</p>\r\n\r\n<ul>\r\n	<li>Basic: Free</li>\r\n	<li>Premium: Monthly Payment. Services can be cancelled anytime</li>\r\n</ul>\r\n\r\n<p>Both the services can be subscribed in one time or recurring services basis.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h2>How to test out services:</h2>\r\n\r\n<p>We offer a test Security service from our portal. Once the customer selects the test service, they can click on &ldquo; Security Services: Test service&rdquo;. This service gives our user a good understanding of all the services we offer to our customer.</p>\r\n\r\n<p>All the Security section of our service is included in our test services. What we do is, just give our user the truncated report of each services. This gives sour customer a good understanding of our services without impacting our ability to upsell our Basic and Premium services</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h2>How We deliver our Premium services:</h2>\r\n\r\n<p>We deliver our services via our portal. Once you log in our site you can click of the type of services and payment method. The payment of the services can be done via paypal, Credit card etc. Once the service has been purchased, an email confirmation will be sent to the user. Generally the first report will take 24-48 hours before being sent to user. Please note that each report is viewed by a qualified IT security specialist to make sure all the requisite process has been accounted for. A IT specialist can also periodically view the report and send additional remediation report as per the security risk. This can be purchased as Add On Services.</p>\r\n</div>\r\n</div>\r\n<style type="text/css">.table-advance thead tr th {\r\n            background-color: #0da3e2;\r\n            font-size: 14px;\r\n            font-weight: 400;\r\n            color: #fff;\r\n        }\r\n        .table-advance thead tr td{\r\n            text-align: center;\r\n        }\r\n</style>\r\n<div class="row-fluid">\r\n<div class="span12 space-mobile">\r\n<h3>Compare our Services</h3>\r\n\r\n<table class="table table-striped table-bordered table-advance table-hover">\r\n	<thead>\r\n		<tr>\r\n			<th>\r\n			<p>Service Type</p>\r\n			</th>\r\n			<th>\r\n			<p>Test Services*</p>\r\n			</th>\r\n			<th>\r\n			<p>Basic**</p>\r\n			</th>\r\n			<th>\r\n			<p>Premium **(Coming Soon)</p>\r\n			</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>WebSite up&nbsp; Test: Simply Monitor</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Specific IT Port check status: Simply Port Monitor</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Run FCC guideline Site evaluation: SMB Risk Assessment(Coming soon)</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Run IT Vulnerability Test: Simply Vulnerability Scanner</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>OS Version</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>SSL Version and cert Check</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Full Port Scan and reports&nbsp;</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Automated IT Vulnerability Check</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>FCC guideline Site Risk Assessment(Coming soon)</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Website Content Integrity Check(Coming soon)</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Website Page&nbsp; Performance Test(Coming soon)</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Recurring Service</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Weekly Website uptime report</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Weekly report</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Monthly Analytical report for Site Performance</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Monthly Analytical report for IT Security</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Monthly recommendation based on website data points</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Monthly Site risk evaluation based on FCC guidelines</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Recurring Fee</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Free</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Free</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Monthly</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cancellation</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Anytime</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Anytime</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Anytime</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Service credit for non-availability of our service. The credit is limited to one monthly fee paid by customer.</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important">No</span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important">No</span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-success">Yes</span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Remediation service</p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important">No</span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center"><span class="label label-important">No</span></p>\r\n			</td>\r\n			<td>\r\n			<p class="text-center">Available for additional cost</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>*All test services can be done without login to the website.</p>\r\n\r\n<p>** User will need to login to our portal for running the basic and premium services</p>\r\n\r\n<h3>Additional Services:</h3>\r\n\r\n<table class="table table-striped table-bordered table-advance table-hover">\r\n	<thead>\r\n		<tr>\r\n			<th>\r\n			<p>Service Type</p>\r\n			</th>\r\n			<th>\r\n			<p>&nbsp;</p>\r\n			</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Professional Services for Security Remediation based on Risk evaluation done by Dimatas Security product. The work is coped and defined by customer as per their business requirement.</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>Remediation service will also involve the ability to website issues&nbsp; and solution to fix the issue.</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td>\r\n			<p>Please contact us</p>\r\n\r\n			<p><a href="mailto:ProfessionalServices@dimatas.com">ProfessionalServices@dimatas.com</a><br />\r\n			&nbsp;</p>\r\n\r\n			<p>The services is delivered based on Statement of work as agreed by Dimatas and customer. The work can be based on time and material or Fixed price.</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>The method of payment can be either Credit Card, Check or current payment methods like Paypal, Google Pay, Apple Pay etc</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'bt', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.1.101', 0, 3),
(11, 3, 'support', 'Support', 'Support', 'Support', '#', '<table border="1" cellpadding="0" cellspacing="0" style="width:100.0%;" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p><strong>Service Name</strong></p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p><strong>Default Port</strong></p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p><strong>Port Function</strong></p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<p><strong>Users&nbsp; side configuration</strong></p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p><strong>Comments</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>check_ftp</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>21</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>FTP Port</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>check_hpjd</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>161</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>HP printer check status with&nbsp; JD card installed</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nThis plugin tests the STATUS of an HP printer with a JetDirect card.</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp; Net-snmp must be installed on the computer running the plugin.</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<pre>\r\n-C, --community=STRING</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The SNMP community name (default=public)</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp; -p, --port=STRING</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Specify the port to check (default=161)</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>check_http</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>80</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>HTTP website&nbsp; port check</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nThis plugin tests the HTTP service on the specified host. It can test</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp; normal (http) and secure (https) servers, follow redirects, search for</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp; strings and regular expressions, check connection times, and report on</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp; certificate expiration times.</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>check_imap</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>143</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nThis plugin tests IMAP connections with the specified host (or unix socket).</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>Check_nt</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>1248</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nThis plugin collects data from the NSClient service running on a Windows NT/2000/XP/2003 server.</pre>\r\n\r\n			<pre>\r\nNotes:</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp; - The NSClient service should be running on the server to get any information</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (http://nsclient.ready2run.nl).</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp; - Critical thresholds should be lower than warning thresholds</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp; - Default port 1248 is sometimes in use by other services. The error</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; output when this happens contains &quot;Cannot map xxxxx to protocol number&quot;.</pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; One fix for this is to change the port to something else on check_nt </pre>\r\n\r\n			<pre>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;and on the client service it&#39;s connecting to.</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>Check_ping</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>7</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nUse ping to check connection statistics for a remote host.</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>Check_Pop</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>109/110</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nThis plugin tests POP connections with the specified host (or unix socket).</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>Check_Smtp</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>25</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>Mail software status check</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nThis plugin will attempt to open an SMTP connection with the host.</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<pre>\r\nport number (default: 25)</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>Check_Snmp</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>161</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nCheck status of remote machines and obtain system information via SNMP</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<pre>\r\nPort number (default: 161)</pre>\r\n\r\n			<pre>\r\nSNMP communication (default is &quot;public&quot;)</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>Check_Ssh</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>22</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<pre>\r\nTry to connect to an SSH server at specified server and port</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<pre>\r\nPort number (default: 22)</pre>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:15.66%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:15.26%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:15.3%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:34.78%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style="width:19.0%;">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 0, 4),
(12, 3, 'tutorial', 'Tutorial', 'Tutorial', 'Tutorial', 'tutorial', '<div class="span12 space-mobile">\r\n<p>Tutorial for Nagios</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tutorial for New data</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n', 't', 'n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 11, 0),
(13, 3, 'knowledgebase', 'Knowledgebase', 'knowledgebase', 'knowledgebase', 'knowledgebase', '<div class="span12 space-mobile">\r\n<p>More data for Knowledge Base</p>\r\n\r\n<h1><strong>More data Coming soon.</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n', 't', 'n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 11, 0),
(14, 3, 'documents', 'Documents', 'Documents', 'Documents', 'documents', '<div class="span12 space-mobile">\r\n<p>More Docs coming soon</p>\r\n</div>\r\n', 't', 'n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 11, 0),
(15, 3, 'customercare', 'Customer Care', 'Customer Care', 'Customer Care', 'customer_care', '   <div class="span12 space-mobile">\r\n            <h2>Choose by Phone</h2>\r\n                <p>(Coming Soon)</p>\r\n            </div>\r\n            \r\n            <div class="span12 space-mobile" style="margin-left:0px;">\r\n            <h2>Choose by mail</h2>\r\n                <p>Send us an email regarding your request for assistance that relates to your missing, wrong, damaged or lost Antida Software.</p>\r\n            	<p><strong style="font-size:16px; font-weight:bold;"><a href="mailto:customersupport@dimatas.com">Mail To</a></strong></p>\r\n            </div>\r\n            \r\n            <div class="span12 space-mobile" style="margin-left:0px;">\r\n            <h2>Choose by Send message</h2>\r\n                <p>Send message to dimatas support using this website.</p>\r\n                <p><strong style="font-size:16px; font-weight:bold;"><a href="#">Send</a></strong></p>\r\n            </div>\r\n            <!-- END INFO BLOCK -->                ', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123.63.42.74', 11, 0),
(16, 3, 'faq', 'FAQ', 'FAQ', 'FAQ', 'faq', '<!-- BEGIN INFO BLOCK -->\r\n<div class="span12 space-mobile">\r\n<div class="ui-accordion ui-widget ui-helper-reset" id="faq_container" role="tablist" style="display: block;">\r\n<h4 aria-controls="ui-accordion-faq_container-panel-0" aria-expanded="false" aria-selected="false" class="faq_header ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons" id="ui-accordion-faq_container-header-0" role="tab" tabindex="0">FAQ section</h4>\r\n\r\n<div aria-hidden="true" aria-labelledby="ui-accordion-faq_container-header-19" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-accordion-faq_container-panel-19" role="tabpanel" style="display: none; height: 40px;">Antida comes with two version. One Free edition and one professional version. Please see the feature list in Dimatas portal to see the list of features that comes with each edition.</div>\r\n</div>\r\n</div>\r\n<!-- END INFO BLOCK -->', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 11, 0),
(17, 3, 'forum', 'Forum', 'Forum', 'Forum', 'forum', '', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '64.242.52.33', 11, 0),
(10, 3, 'simplyscanner', 'Simply Scanner', 'Simply Scanner', 'Simply Scanner', 'simply-scanner', '<div class="row-fluid margin-bottom-30">\r\n<div class="span12 space-mobile">\r\n<p>Simply Port Scanner is a IP/website port scanning software. The tool is based on opensourcenmap scanning software which provides the core engine of the scanning software. Simply port Scan is IT ports Scanner .</p>\r\n\r\n<p><b>Simply Port Scanner</b> can be used for scanning both large corporate networks that have hundreds of computers or small home networks with several computers. While the program can scan a list of IP addresses, ranges of IP addresses, the number of computers and subnets is unlimited. It can also scan a Website or Fully qualified URL.</p>\r\n\r\n<p>Give it a try and you will be surprised how simple and easy it is to find detail about your website and open ports</p>\r\n\r\n<h2>SimplyScan can be used for</h2>\r\n\r\n<ol>\r\n	<li>Security Auditing of device( Compute/network/Storage)</li>\r\n	<li>Identifying open ports on target device</li>\r\n	<li>Network Inventory, network mapping</li>\r\n	<li>Generating traffic to host server</li>\r\n</ol>\r\n\r\n<h2>Simply Port scanner Key features</h2>\r\n\r\n<ul>\r\n	<li>Cloud based Scanning solution. No need to download or install any software.</li>\r\n	<li>A simple, user-friendly interface makes operation easy for users</li>\r\n	<li>Start your scan and get results in minutes</li>\r\n	<li>Store and use the result of future use</li>\r\n	<li>Pings computer and displays result of alive and uptime</li>\r\n	<li>Detects hardware MAC-addresses, even across routers.</li>\r\n	<li>Scans for listening TCP ports, some UDP and SNMP services.</li>\r\n	<li><b>Available to all users</b>. No administrator privileges are required for scanning.</li>\r\n</ul>\r\n\r\n<h2>Some more advance features of Simply Port Scanner</h2>\r\n\r\n<ul>\r\n	<li>Ability to scan Windows, Linux, Solaris, AIX and any other operating system</li>\r\n	<li>Detects any network devices, servers, firewall etc devices based on IP visibility</li>\r\n	<li>Scans ports and finds HTTP, HTTPS, FTP, RDP</li>\r\n	<li>Allows to run scan in multiple options (Check Simply Port Scanner Advance Conf explanation below for more details)</li>\r\n	<li>\r\n	<ol>\r\n		<li>Simple Scan</li>\r\n		<li>Fast Scan</li>\r\n		<li>Verbose Scan</li>\r\n		<li>Custom Scan</li>\r\n	</ol>\r\n	</li>\r\n	<li>Sends email once the scan is completed</li>\r\n	<li>Sends the scan result as email attachment to the user and also stored the last five scan in Dimatas website</li>\r\n</ul>\r\n\r\n<h2>Simply Port Scanner Advance configuration options Explanation</h2>\r\n<style type="text/css">.table-advance thead tr th {\r\n                        background-color: #0da3e2;\r\n                        font-size: 14px;\r\n                        font-weight: 400;\r\n                        color: #fff;\r\n                    }\r\n                    .table-advance thead tr td{\r\n                        text-align: center;\r\n                    }\r\n</style>\r\n<h5><b>TCP Connect Scan</b></h5>\r\n\r\n<p>In this connection every usable port in the machine is connected. If the port is listening, the TCP Connect will succeed otherwise the port will be listed as unreachable</p>\r\n\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<div class="span6">\r\n<table class="table table-striped table-bordered table-advance table-hover">\r\n	<thead>\r\n		<tr>\r\n			<th>\r\n			<p>Advantage</p>\r\n			</th>\r\n			<th>\r\n			<p>Disadvantage</p>\r\n			</th>\r\n		</tr>\r\n		<tr>\r\n			<td>Speed</td>\r\n			<td>Easy Detectable and filtered</td>\r\n		</tr>\r\n		<tr>\r\n			<td>No Special Privilege</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h5><b>TCP SYN</b></h5>\r\n\r\n<p>TCP SYNC does not create a TCP session so it is not logged by host or application</p>\r\n\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<div class="span6">\r\n<table class="table table-striped table-bordered table-advance table-hover">\r\n	<thead>\r\n		<tr>\r\n			<th>\r\n			<p>Advantage</p>\r\n			</th>\r\n			<th>\r\n			<p>Disadvantage</p>\r\n			</th>\r\n		</tr>\r\n		<tr>\r\n			<td>NO Session opened</td>\r\n			<td>Needs previledge access. We offer to customer from our portal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Easy on Application</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h5><b>XSCAN, FIN Scan</b></h5>\r\n\r\n<p>Null Scan are called Stealth Scans because they send only single frame to TCP port without any TCP handshake. The response is either closed or open|Filtered.</p>\r\n\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<div class="span6">\r\n<table class="table table-striped table-bordered table-advance table-hover">\r\n	<thead>\r\n		<tr>\r\n			<th>\r\n			<p>Advantage</p>\r\n			</th>\r\n			<th>\r\n			<p>Disadvantage</p>\r\n			</th>\r\n		</tr>\r\n		<tr>\r\n			<td>NO full Session opened</td>\r\n			<td>Needs privilege access. We offer to customer from our portal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Easy on Application</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Identified TCP port</td>\r\n			<td>Does not identify UCP port</td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h2>About Namp: Simply Port Scan Software engine</h2>\r\n\r\n<p>Nmap (&ldquo;Network Mapper&rdquo;) is an open source tool for network exploration and security auditing. It was designed to rapidly scan large networks, although it works fine against single hosts. Nmap uses raw IP packets in novel ways to determine what hosts are available on the network, what services (application name and version) those hosts are offering, what operating systems (and OS versions) they are running, what type of packet filters/firewalls are in use, and dozens of other characteristics. While Nmap is commonly used for security audits, many systems and network administrators find it useful for routine tasks such as network inventory, managing service upgrade schedules, and monitoring host or service uptime.</p>\r\n\r\n<h2>Key features of Nmap are</h2>\r\n\r\n<ul>\r\n	<li><b>Flexible:</b> Supports dozens of advanced techniques for mapping out networks filled with IP filters, firewalls, routers, and other obstacles. This includes many port scanning mechanisms (both TCP &amp; UDP), OS detection, version detection, ping sweeps, and more. See the documentation page.</li>\r\n	<li><b>Powerful:</b> Nmap has been used to scan huge networks of literally hundreds of thousands of machines.</li>\r\n	<li><b>Portable:</b> Most operating systems are supported, including Linux, Microsoft Windows, FreeBSD, OpenBSD, Solaris, IRIX, Mac OS X, HP-UX, NetBSD, Sun OS, Amiga, and more.</li>\r\n	<li><b>Easy:</b> While Nmap offers a rich set of advanced features for power users, you can start out as simply as &quot;nmap -v -A targethost&quot;. Both traditional command line and graphical (GUI) versions are available to suit your preference. Binaries are available for those who do not wish to compile Nmap from source.</li>\r\n	<li><b>Free:</b> The primary goals of the Nmap Project is to help make the Internet a little more secure and to provide administrators/auditors/hackers with an advanced tool for exploring their networks. Nmap is available for free download, and also comes with full source code that you may modify and redistribute under the terms of the license.</li>\r\n	<li><b>Well Documented:</b> Significant effort has been put into comprehensive and up-to-date man pages, whitepapers, tutorials, and even a whole book! Find them in multiple languages here.</li>\r\n	<li><b>Supported:</b> While Nmap comes with no warranty, it is well supported by a vibrant community of developers and users. Most of this interaction occurs on theNmap mailing lists. Most bug reports and questions should be sent to the nmap-dev list, but only after you read the guidelines. We recommend that all users subscribe to the low-traffic nmap-hackers announcement list. You can also find Nmap on Facebook and Twitter. For real-time chat, join the #nmap channel onFreenode or EFNet.</li>\r\n	<li><b>Acclaimed:</b> Nmap has won numerous awards, including &quot;Information Security Product of the Year&quot; by Linux Journal, Info World and Codetalker Digest. It has been featured in hundreds of magazine articles, several movies, dozens of books, and one comic book series. Visit the press page for further details.</li>\r\n	<li><b>Popular:</b> Thousands of people download Nmap every day, and it is included with many operating systems (Redhat Linux, Debian Linux, Gentoo, FreeBSD, OpenBSD, etc). It is among the top ten (out of 30,000) programs at the Freshmeat.Net repository. This is important because it lends Nmap its vibrant development and user support communities.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n', 'bt', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.1.101', 20, 0);
INSERT INTO `content` (`id`, `user_id`, `page_name`, `page_title`, `page_metakeywords`, `page_metadesc`, `page_url`, `page_desc`, `page_position`, `status`, `created`, `updated`, `ipaddress`, `page_parent`, `order_number`) VALUES
(20, 3, 'products', 'Products', 'Products', 'Products', 'products', '<p>â€‹\r\n<style type="text/css">.front-team h3 a{\r\n               font-size:19px;\r\n           }\r\n</style>\r\n</p>\r\n\r\n<div class="row-fluid margin-bottom-30">\r\n<div class="span7 space-mobile">\r\n<h2>What Dimatas can do for your Web Security and management of online business?</h2>\r\n\r\n<p><b>Dimatas</b> offers a comprehensive Cloud based monitoring and security solution for SMB and individual customers. We offer a solution that give our end users a easy to use cloud based solution that continuously monitor and reports on website accessibility and security. All what we need is a IP based internet accessible device sitting anywhere in the world.</p>\r\n\r\n<p>We also offer subscription based service for our SMB customer who want to get comprehensive analytical report.</p>\r\n</div>\r\n\r\n<div class="span5">&nbsp;</div>\r\n</div>\r\n\r\n<div class="row-fluid margin-bottom-20">\r\n<div class="span12">\r\n<div class="row-fluid margin-bottom-20">\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>Free Services</h2>\r\n\r\n<p>Small business and Individual customers can use all our services for free. This includes using the monitoring, security and some assessment features.</p>\r\n</div>\r\n\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>Use only freeware based enterprise Architecture</h2>\r\n\r\n<p>Our services are based on highly vetted open source architecture. We use free ware where we can give our customer lots of free and advance services.</p>\r\n</div>\r\n\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>Accurate</h2>\r\n\r\n<p>Advance open stack based design gives our customer accurate and predictable solution for customer.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid margin-bottom-20">\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>Fully Automated</h2>\r\n\r\n<p>User can use our fully automated feature to get periodic data. This gives customer a comprehensive look at their infrastructure.</p>\r\n</div>\r\n\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>Easy to use</h2>\r\n\r\n<p>Advance and responsive GUI gives our customer agile website which is easy to use. You don&rsquo;t need to be technically Savvy for using this services. Just use your website URL and you are ready to go.</p>\r\n</div>\r\n\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>Details reports</h2>\r\n\r\n<p>Detail reports are available for all products as needed by customer.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid margin-bottom-20">\r\n<div class="span4 service-box-v1">\r\n<div><i class="icon-cloud-download color-grey"></i></div>\r\n\r\n<h2>$1 USD per month Website solution for all customers( Coming soon)</h2>\r\n\r\n<p>Our freeware and open source design gives our customer an economically viable monitoring and security solution.</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid margin-bottom-20">\r\n<h2 class="text-center">Our Products</h2>\r\n\r\n<div class="row-fluid front-team">\r\n<ul class="thumbnails">\r\n	<li class="span3 space-mobile">\r\n	<h3><a href="http://www.dimatas.com/simply-monitor">SimplyMonitor</a></h3>\r\n\r\n	<p>SimplyMonitor is a Cloud based IT infrastructure monitoring software .Simply Monitor is computers and networking monitoring tool that helps user( individual or enterprise) to manage availability, Performance and utilization of the infrastructure. Its simple cloud based design enables user get all the monitoring done very easily.</p>\r\n\r\n	<ul class="social-icons social-icons-color">\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n	</ul>\r\n	</li>\r\n	<li class="span3 space-mobile">\r\n	<h3><a href="http://www.dimatas.com/simply-scanner">Simply Port Scanner</a></h3>\r\n\r\n	<p>Simply Port Scanner is a IP/website port scanning software. The tool is based on opensourcenmap scanning software which provides the core engine of the scanning software. Simply port Scan is IT ports Scanner.</p>\r\n\r\n	<p>Simply Port Scanner can be used for scanning both large corporate networks that have hundreds of computers or small home networks with several computers. While the program can scan a list of IP addresses, ranges of IP addresses, the number of computers and subnets is unlimited. It can also scan a Website or Fully qualified URL.</p>\r\n\r\n	<ul class="social-icons social-icons-color">\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n	</ul>\r\n	</li>\r\n	<li class="span3 space-mobile">\r\n	<h3><a href="http://www.dimatas.com/simply-vulnerability-scanner">Simply Vulnerability Scanner</a></h3>\r\n\r\n	<p>A vulnerability scanner is a computer program designed to assess computers, computer systems, networks or applications for weaknesses. They can be run either as part of vulnerability management by those tasked with protecting systems - or by black hat attackers looking to gain unauthorized access.</p>\r\n\r\n	<p>Simply Vulnerability Scanner is a cloud based scanner that is designed on OpenVAS open source software. It get the same level of updates feeds of Network Vulnerability as OpenVAS.</p>\r\n\r\n	<ul class="social-icons social-icons-color">\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n	</ul>\r\n	</li>\r\n	<li class="span3">\r\n	<h3><a>SMB Security Risk Assessment</a> <small>Coming Soon</small></h3>\r\n\r\n	<p>Small and Medium business need to develop security based on their need. Our Detail Security assessment is based on questionnaire response. The questionnaire are based on United states of America Federal Communication Commission(USA FCC) guidelines for small and medium business.</p>\r\n\r\n	<ul class="social-icons social-icons-color">\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n		<li>&nbsp;</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n', 't', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.1.100', 0, 1),
(21, 3, 'simplyvulnerabilityscanner', 'Simply Vulnerability Scanner', 'Simply Vulnerability Scanner', 'Simply Vulnerability Scanner', 'simply-vulnerability-scanner', '<div class="row-fluid margin-bottom-30">\r\n<div class="span12">\r\n<p>A <b>vulnerability scanner</b> is a computer program designed to assess computers, computer systems, networks or applications for weaknesses. They can be run either as part of <b>vulnerability</b> management by those tasked with protecting systems - or by black hat attackers looking to gain unauthorized access.</p>\r\n\r\n<p><b>Simply Vulnerability Scanner</b> is a cloud based scanner that is designed on OpenVAS open source software. It get the same level of updates feeds of Network Vulnerability as OpenVAS.</p>\r\n\r\n<p>Our Scanner works by testing each port on a computer, determining what service it is running, and then testing this service to make sure there are no vulnerabilities in it that could be used by a hacker to carry out a malicious attack. Our product is a cloud based software which needs nothing to be installed on customer end computer/network for the test to happen. Customer can just login to our portal and start the scan and get the results mailed to them.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<div class="row-fluid">\r\n<div class="span6">\r\n<h2>Key Features of Simply Vulnerability Software</h2>\r\n\r\n<ol>\r\n	<li>VULNERABILITY SCANNING THAT IS FAST AND NON-INTRUSIVE</li>\r\n	<li>Cloud Based software. NO SOFTWARE INSTALL NEEDED</li>\r\n	<li>Most comprehensive database for vulnerabilities. All based on openVAS</li>\r\n	<li>NO LICENSING FEE. FREE FOR USE</li>\r\n	<li>FIND security exposures in network, websites, databases, Servers etc</li>\r\n	<li>A great tool designed to automate the testing and discovery of known security problems</li>\r\n</ol>\r\n</div>\r\n\r\n<div class="span6">\r\n<h2>Implemented features for our Simply Vulnerability Scanner</h2>\r\n\r\n<ul>\r\n	<li>Simple and free sign up.</li>\r\n	<li>Perform checks every 60 seconds!</li>\r\n	<li>Online tool, no need to install any software in your server or website.</li>\r\n	<li>Monitor websites, servers, custom TCP ports and DNS hostnames.</li>\r\n	<li>Advanced website monitoring: check for content matching in your website.</li>\r\n	<li>Email notifications to multiple email addresses.</li>\r\n	<li>Custom Dashboard</li>\r\n	<li>Response time (performance) and uptime reports.</li>\r\n	<li>Weekly or monthly customized email reports.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<h2>About our Software Engine</h2>\r\n\r\n<div class="row-fluid">\r\n<div class="span6">\r\n<h5><b>OpenVAS: Simply Vulnerability Scanner Software Engine</b></h5>\r\n\r\n<p>The Open Vulnerability Assessment System (OpenVAS) is a framework of several services and tools offering a comprehensive and powerful vulnerability scanning and vulnerability management solution.</p>\r\n<img src="http://dimatas.com/assests/site/img/openvas2.png" /></div>\r\n\r\n<div class="span6"><img src="http://dimatas.com/assests/site/img/openvas.png" /></div>\r\n</div>\r\n\r\n<div class="row-fluid margin-bottom-30">\r\n<div class="span12">\r\n<h5><b>About OpenVAS NVT Feed</b></h5>\r\n\r\n<p>The OpenVAS project maintains a public feed of Network Vulnerability Tests (NVTs). It contains more than 35,000 NVTs (as of April 2014), growing on a daily basis. This feed is configured as the default for OpenVAS.</p>\r\n\r\n<p>For online-synchronisation use the command openvas-nvt-sync to update your local NVTs with the newest ones from the feed service. The command allows rsync, wget or curl as transfer method.</p>\r\n\r\n<p>For offline-updates it is also possible to download the whole Feed content as a single archive file (around 14 MByte). However, it is recommended to use the rsync-synchronisation routine because it downloads only changes and therefore is tremendously faster after the very first full download.</p>\r\n\r\n<p>The feed is usually updated weekly. The files of the OpenVAS NVT Feed are signed by the &quot;OpenVAS: Transfer Integrity&quot; certificate. The presence of this signature does not indicate any judgement or quality control of the script itself. It is only intended to assist you in verifying the integrity of the NVT files after transfer. Thus, a valid signature only means that the script has not been modified on the way between the OpenVAS distribution point and your OpenVAS installation.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', 'bt', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.1.101', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `val` varchar(25) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `status` enum('y','n') NOT NULL DEFAULT 'y'
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `val`, `name`, `status`) VALUES
(1, 'AF', 'Afghanistan', 'y'),
(2, 'AL', 'Albania', 'y'),
(3, 'DZ', 'Algeria', 'y'),
(4, 'AS', 'American Samoa', 'y'),
(5, 'AD', 'Andorra', 'y'),
(6, 'AO', 'Angola', 'y'),
(7, 'AI', 'Anguilla', 'y'),
(8, 'AQ', 'Antarctica', 'y'),
(9, 'AG', 'Antigua and Barbuda', 'y'),
(10, 'AR', 'Argentina', 'y'),
(11, 'AM', 'Armenia', 'y'),
(12, 'AW', 'Aruba', 'y'),
(13, 'AU', 'Australia', 'y'),
(14, 'AT', 'Austria', 'y'),
(15, 'AZ', 'Azerbaijan', 'y'),
(16, 'BS', 'Bahamas', 'y'),
(17, 'BH', 'Bahrain', 'y'),
(18, 'BD', 'Bangladesh', 'y'),
(19, 'BB', 'Barbados', 'y'),
(20, 'BY', 'Belarus', 'y'),
(21, 'BE', 'Belgium', 'y'),
(22, 'BZ', 'Belize', 'y'),
(23, 'BJ', 'Benin', 'y'),
(24, 'BM', 'Bermuda', 'y'),
(25, 'BT', 'Bhutan', 'y'),
(26, 'BO', 'Bolivia', 'y'),
(27, 'BA', 'Bosnia and Herzegovina', 'y'),
(28, 'BW', 'Botswana', 'y'),
(29, 'BV', 'Bouvet Island', 'y'),
(30, 'BR', 'Brazil', 'y'),
(31, 'BQ', 'British Antarctic Territory', 'y'),
(32, 'IO', 'British Indian Ocean Territory', 'y'),
(33, 'VG', 'British Virgin Islands', 'y'),
(34, 'BN', 'Brunei', 'y'),
(35, 'BG', 'Bulgaria', 'y'),
(36, 'BF', 'Burkina Faso', 'y'),
(37, 'BI', 'Burundi', 'y'),
(38, 'KH', 'Cambodia', 'y'),
(39, 'CM', 'Cameroon', 'y'),
(40, 'CA', 'Canada', 'y'),
(41, 'CT', 'Canton and Enderbury Islands', 'y'),
(42, 'CV', 'Cape Verde', 'y'),
(43, 'KY', 'Cayman Islands', 'y'),
(44, 'CF', 'Central African Republic', 'y'),
(45, 'TD', 'Chad', 'y'),
(46, 'CL', 'Chile', 'y'),
(47, 'CN', 'China', 'y'),
(48, 'CX', 'Christmas Island', 'y'),
(49, 'CC', 'Cocos [Keeling] Islands', 'y'),
(50, 'CO', 'Colombia', 'y'),
(51, 'KM', 'Comoros', 'y'),
(52, 'CG', 'Congo - Brazzaville', 'y'),
(53, 'CD', 'Congo - Kinshasa', 'y'),
(54, 'CK', 'Cook Islands', 'y'),
(55, 'CR', 'Costa Rica', 'y'),
(56, 'HR', 'Croatia', 'y'),
(57, 'CU', 'Cuba', 'y'),
(58, 'CY', 'Cyprus', 'y'),
(59, 'CZ', 'Czech Republic', 'y'),
(60, 'CI', 'Côte d’Ivoire', 'y'),
(61, 'DK', 'Denmark', 'y'),
(62, 'DJ', 'Djibouti', 'y'),
(63, 'DM', 'Dominica', 'y'),
(64, 'DO', 'Dominican Republic', 'y'),
(65, 'NQ', 'Dronning Maud Land', 'y'),
(66, 'DD', 'East Germany', 'y'),
(67, 'EC', 'Ecuador', 'y'),
(68, 'EG', 'Egypt', 'y'),
(69, 'SV', 'El Salvador', 'y'),
(70, 'GQ', 'Equatorial Guinea', 'y'),
(71, 'ER', 'Eritrea', 'y'),
(72, 'EE', 'Estonia', 'y'),
(73, 'ET', 'Ethiopia', 'y'),
(74, 'FK', 'Falkland Islands', 'y'),
(75, 'FO', 'Faroe Islands', 'y'),
(76, 'FJ', 'Fiji', 'y'),
(77, 'FI', 'Finland', 'y'),
(78, 'FR', 'France', 'y'),
(79, 'GF', 'French Guiana', 'y'),
(80, 'PF', 'French Polynesia', 'y'),
(81, 'TF', 'French Southern Territories', 'y'),
(82, 'FQ', 'French Southern and Antarctic Territories', 'y'),
(83, 'GA', 'Gabon', 'y'),
(84, 'GM', 'Gambia', 'y'),
(85, 'GE', 'Georgia', 'y'),
(86, 'DE', 'Germany', 'y'),
(87, 'GH', 'Ghana', 'y'),
(88, 'GI', 'Gibraltar', 'y'),
(89, 'GR', 'Greece', 'y'),
(90, 'GL', 'Greenland', 'y'),
(91, 'GD', 'Grenada', 'y'),
(92, 'GP', 'Guadeloupe', 'y'),
(93, 'GU', 'Guam', 'y'),
(94, 'GT', 'Guatemala', 'y'),
(95, 'GG', 'Guernsey', 'y'),
(96, 'GN', 'Guinea', 'y'),
(97, 'GW', 'Guinea-Bissau', 'y'),
(98, 'GY', 'Guyana', 'y'),
(99, 'HT', 'Haiti', 'y'),
(100, 'HM', 'Heard Island and McDonald Islands', 'y'),
(101, 'HN', 'Honduras', 'y'),
(102, 'HK', 'Hong Kong SAR China', 'y'),
(103, 'HU', 'Hungary', 'y'),
(104, 'IS', 'Iceland', 'y'),
(105, 'IN', 'India', 'y'),
(106, 'val', 'Indonesia', 'y'),
(107, 'IR', 'Iran', 'y'),
(108, 'IQ', 'Iraq', 'y'),
(109, 'IE', 'Ireland', 'y'),
(110, 'IM', 'Isle of Man', 'y'),
(111, 'IL', 'Israel', 'y'),
(112, 'IT', 'Italy', 'y'),
(113, 'JM', 'Jamaica', 'y'),
(114, 'JP', 'Japan', 'y'),
(115, 'JE', 'Jersey', 'y'),
(116, 'JT', 'Johnston Island', 'y'),
(117, 'JO', 'Jordan', 'y'),
(118, 'KZ', 'Kazakhstan', 'y'),
(119, 'KE', 'Kenya', 'y'),
(120, 'KI', 'Kiribati', 'y'),
(121, 'KW', 'Kuwait', 'y'),
(122, 'KG', 'Kyrgyzstan', 'y'),
(123, 'LA', 'Laos', 'y'),
(124, 'LV', 'Latvia', 'y'),
(125, 'LB', 'Lebanon', 'y'),
(126, 'LS', 'Lesotho', 'y'),
(127, 'LR', 'Liberia', 'y'),
(128, 'LY', 'Libya', 'y'),
(129, 'LI', 'Liechtenstein', 'y'),
(130, 'LT', 'Lithuania', 'y'),
(131, 'LU', 'Luxembourg', 'y'),
(132, 'MO', 'Macau SAR China', 'y'),
(133, 'MK', 'Macedonia', 'y'),
(134, 'MG', 'Madagascar', 'y'),
(135, 'MW', 'Malawi', 'y'),
(136, 'MY', 'Malaysia', 'y'),
(137, 'MV', 'Maldives', 'y'),
(138, 'ML', 'Mali', 'y'),
(139, 'MT', 'Malta', 'y'),
(140, 'MH', 'Marshall Islands', 'y'),
(141, 'MQ', 'Martinique', 'y'),
(142, 'MR', 'Mauritania', 'y'),
(143, 'MU', 'Mauritius', 'y'),
(144, 'YT', 'Mayotte', 'y'),
(145, 'FX', 'Metropolitan France', 'y'),
(146, 'MX', 'Mexico', 'y'),
(147, 'FM', 'Micronesia', 'y'),
(148, 'MI', 'Mvalway Islands', 'y'),
(149, 'MD', 'Moldova', 'y'),
(150, 'MC', 'Monaco', 'y'),
(151, 'MN', 'Mongolia', 'y'),
(152, 'ME', 'Montenegro', 'y'),
(153, 'MS', 'Montserrat', 'y'),
(154, 'MA', 'Morocco', 'y'),
(155, 'MZ', 'Mozambique', 'y'),
(156, 'MM', 'Myanmar [Burma]', 'y'),
(157, 'NA', 'Namibia', 'y'),
(158, 'NR', 'Nauru', 'y'),
(159, 'NP', 'Nepal', 'y'),
(160, 'NL', 'Netherlands', 'y'),
(161, 'AN', 'Netherlands Antilles', 'y'),
(162, 'NT', 'Neutral Zone', 'y'),
(163, 'NC', 'New Caledonia', 'y'),
(164, 'NZ', 'New Zealand', 'y'),
(165, 'NI', 'Nicaragua', 'y'),
(166, 'NE', 'Niger', 'y'),
(167, 'NG', 'Nigeria', 'y'),
(168, 'NU', 'Niue', 'y'),
(169, 'NF', 'Norfolk Island', 'y'),
(170, 'KP', 'North Korea', 'y'),
(171, 'VD', 'North Vietnam', 'y'),
(172, 'MP', 'Northern Mariana Islands', 'y'),
(173, 'NO', 'Norway', 'y'),
(174, 'OM', 'Oman', 'y'),
(175, 'PC', 'Pacific Islands Trust Territory', 'y'),
(176, 'PK', 'Pakistan', 'y'),
(177, 'PW', 'Palau', 'y'),
(178, 'PS', 'Palestinian Territories', 'y'),
(179, 'PA', 'Panama', 'y'),
(180, 'PZ', 'Panama Canal Zone', 'y'),
(181, 'PG', 'Papua New Guinea', 'y'),
(182, 'PY', 'Paraguay', 'y'),
(183, 'YD', 'People''s Democratic Republic of Yemen', 'y'),
(184, 'PE', 'Peru', 'y'),
(185, 'PH', 'Philippines', 'y'),
(186, 'PN', 'Pitcairn Islands', 'y'),
(187, 'PL', 'Poland', 'y'),
(188, 'PT', 'Portugal', 'y'),
(189, 'PR', 'Puerto Rico', 'y'),
(190, 'QA', 'Qatar', 'y'),
(191, 'RO', 'Romania', 'y'),
(192, 'RU', 'Russia', 'y'),
(193, 'RW', 'Rwanda', 'y'),
(194, 'RE', 'Réunion', 'y'),
(195, 'BL', 'Saint Barthélemy', 'y'),
(196, 'SH', 'Saint Helena', 'y'),
(197, 'KN', 'Saint Kitts and Nevis', 'y'),
(198, 'LC', 'Saint Lucia', 'y'),
(199, 'MF', 'Saint Martin', 'y'),
(200, 'PM', 'Saint Pierre and Miquelon', 'y'),
(201, 'VC', 'Saint Vincent and the Grenadines', 'y'),
(202, 'WS', 'Samoa', 'y'),
(203, 'SM', 'San Marino', 'y'),
(204, 'SA', 'Saudi Arabia', 'y'),
(205, 'SN', 'Senegal', 'y'),
(206, 'RS', 'Serbia', 'y'),
(207, 'CS', 'Serbia and Montenegro', 'y'),
(208, 'SC', 'Seychelles', 'y'),
(209, 'SL', 'Sierra Leone', 'y'),
(210, 'SG', 'Singapore', 'y'),
(211, 'SK', 'Slovakia', 'y'),
(212, 'SI', 'Slovenia', 'y'),
(213, 'SB', 'Solomon Islands', 'y'),
(214, 'SO', 'Somalia', 'y'),
(215, 'ZA', 'South Africa', 'y'),
(216, 'GS', 'South Georgia and the South Sandwich Islands', 'y'),
(217, 'KR', 'South Korea', 'y'),
(218, 'ES', 'Spain', 'y'),
(219, 'LK', 'Sri Lanka', 'y'),
(220, 'SD', 'Sudan', 'y'),
(221, 'SR', 'Suriname', 'y'),
(222, 'SJ', 'Svalbard and Jan Mayen', 'y'),
(223, 'SZ', 'Swaziland', 'y'),
(224, 'SE', 'Sweden', 'y'),
(225, 'CH', 'Switzerland', 'y'),
(226, 'SY', 'Syria', 'y'),
(227, 'ST', 'São Tomé and Príncipe', 'y'),
(228, 'TW', 'Taiwan', 'y'),
(229, 'TJ', 'Tajikistan', 'y'),
(230, 'TZ', 'Tanzania', 'y'),
(231, 'TH', 'Thailand', 'y'),
(232, 'TL', 'Timor-Leste', 'y'),
(233, 'TG', 'Togo', 'y'),
(234, 'TK', 'Tokelau', 'y'),
(235, 'TO', 'Tonga', 'y'),
(236, 'TT', 'Trinvalad and Tobago', 'y'),
(237, 'TN', 'Tunisia', 'y'),
(238, 'TR', 'Turkey', 'y'),
(239, 'TM', 'Turkmenistan', 'y'),
(240, 'TC', 'Turks and Caicos Islands', 'y'),
(241, 'TV', 'Tuvalu', 'y'),
(242, 'UM', 'U.S. Minor Outlying Islands', 'y'),
(243, 'PU', 'U.S. Miscellaneous Pacific Islands', 'y'),
(244, 'VI', 'U.S. Virgin Islands', 'y'),
(245, 'UG', 'Uganda', 'y'),
(246, 'UA', 'Ukraine', 'y'),
(247, 'SU', 'Union of Soviet Socialist Republics', 'y'),
(248, 'AE', 'United Arab Emirates', 'y'),
(249, 'GB', 'United Kingdom', 'y'),
(250, 'US', 'United States', 'y'),
(251, 'ZZ', 'Unknown or Invalval Region', 'y'),
(252, 'UY', 'Uruguay', 'y'),
(253, 'UZ', 'Uzbekistan', 'y'),
(254, 'VU', 'Vanuatu', 'y'),
(255, 'VA', 'Vatican City', 'y'),
(256, 'VE', 'Venezuela', 'y'),
(257, 'VN', 'Vietnam', 'y'),
(258, 'WK', 'Wake Island', 'y'),
(259, 'WF', 'Wallis and Futuna', 'y'),
(260, 'EH', 'Western Sahara', 'y'),
(261, 'YE', 'Yemen', 'y'),
(262, 'ZM', 'Zambia', 'y'),
(263, 'ZW', 'Zimbabwe', 'y'),
(264, 'AX', 'Åland Islands', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `hosts`
--

CREATE TABLE IF NOT EXISTS `hosts` (
  `id` double NOT NULL,
  `nconf_host_id` double NOT NULL,
  `host_alias` varchar(200) NOT NULL,
  `host_name` varchar(200) NOT NULL,
  `host_ip` varchar(200) NOT NULL,
  `host_os` double NOT NULL,
  `host_preset` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hosts`
--

INSERT INTO `hosts` (`id`, `nconf_host_id`, `host_alias`, `host_name`, `host_ip`, `host_os`, `host_preset`) VALUES
(1, 5730, 'google.com', 'http://google.com', '216.58.219.206', 0, 0),
(2, 5733, 'facebook.com', 'http://facebook.com', '31.13.90.2', 0, 0),
(3, 5734, 'Yahoo.com', 'http://Yahoo.com', '98.138.253.109', 0, 0),
(4, 5736, 'google.com', 'http://www.google.com', '74.125.228.230', 0, 0),
(5, 5740, 'timesofindia.com', 'http://timesofindia.com', '223.165.25.18', 0, 0),
(6, 5741, 'netispy.com', 'http://netispy.com', '119.18.57.101', 0, 0),
(7, 5743, 'trello.com', 'http://trello.com', '185.11.124.4', 0, 0),
(8, 5747, 'bookmyshow.com', 'http://bookmyshow.com', '54.231.243.137', 0, 0),
(9, 5748, 'dimatas.com', 'http://dimatas.com', '54.172.144.121', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `host_scans`
--

CREATE TABLE IF NOT EXISTS `host_scans` (
  `id` double NOT NULL,
  `host_id` double NOT NULL,
  `user_id` double NOT NULL,
  `added_date` datetime NOT NULL,
  `last_scan_date` datetime NOT NULL,
  `scan_status` enum('p','c') NOT NULL DEFAULT 'p' COMMENT 'p=pending,completed',
  `output` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_scans`
--

INSERT INTO `host_scans` (`id`, `host_id`, `user_id`, `added_date`, `last_scan_date`, `scan_status`, `output`) VALUES
(1, 1, 4, '2014-11-12 11:17:45', '2014-11-12 11:17:45', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-12 11:17 UTC","Nmap scan report for 74.125.228.85","Host is up (0.0023s latency).","Not shown: 998 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","Device type: specialized|WAP|media device","Running (JUST GUESSING): Crestron 2-Series (85%), Netgear embedded (85%), Western Digital embedded (85%)","OS CPE: cpe:/o:crestron:2_series cpe:/h:netgear:dg834g cpe:/o:westerndigital:wd_tv","Aggressive OS guesses: Crestron XPanel control system (85%), Netgear DG834G WAP or Western Digital WD TV media player (85%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 16.70 seconds"]'),
(2, 2, 11, '2014-11-12 17:02:27', '2014-11-12 17:02:27', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-12 17:02 UTC","Nmap scan report for 173.161.209.35","Host is up (0.018s latency).","Not shown: 987 closed ports","PORT     STATE    SERVICE","22/tcp   open     ssh","25/tcp   open     smtp","53/tcp   open     domain","80/tcp   open     http","110/tcp  open     pop3","135/tcp  filtered msrpc","139/tcp  filtered netbios-ssn","143/tcp  open     imap","445/tcp  filtered microsoft-ds","993/tcp  open     imaps","995/tcp  open     pop3s","1080/tcp filtered socks","8080/tcp open     http-proxy","Device type: general purpose|WAP|media device|webcam|phone|broadband router","Running (JUST GUESSING): Linux 2.6.X|3.X (96%), Netgear embedded (91%), Western Digital embedded (91%), AXIS Linux 2.6.X (90%), Nokia Linux 2.6.X (90%)","OS CPE: cpe:/o:linux:linux_kernel:2.6 cpe:/o:linux:linux_kernel:3 cpe:/h:netgear:dg834g cpe:/o:westerndigital:wd_tv cpe:/h:axis:210a_network_camera cpe:/h:axis:211_network_camera cpe:/o:axis:linux_kernel:2.6 cpe:/o:nokia:linux_kernel:2.6","Aggressive OS guesses: Linux 2.6.32 - 3.9 (96%), Linux 3.8 (95%), Linux 2.6.32 - 3.2 (94%), Linux 3.0 (94%), Linux 3.0 - 3.9 (93%), Linux 2.6.32 - 3.6 (93%), Linux 2.6.32 (93%), Linux 3.0 - 3.1 (93%), Linux 2.6.38 - 3.0 (92%), Linux 3.2 (92%)","No exact OS matches for host (test conditions non-ideal).","Network Distance: 18 hops","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 261.75 seconds"]'),
(3, 3, 11, '2014-11-12 17:06:51', '2014-11-12 17:06:51', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-12 17:06 UTC","Nmap scan report for 173.161.209.35","Host is up (0.022s latency).","Not shown: 987 closed ports","PORT     STATE    SERVICE","22/tcp   open     ssh","25/tcp   open     smtp","53/tcp   open     domain","80/tcp   open     http","110/tcp  open     pop3","135/tcp  filtered msrpc","139/tcp  filtered netbios-ssn","143/tcp  open     imap","445/tcp  filtered microsoft-ds","993/tcp  open     imaps","995/tcp  open     pop3s","1080/tcp filtered socks","8080/tcp open     http-proxy","Aggressive OS guesses: Linux 2.6.32 - 3.9 (96%), Linux 3.8 (95%), Linux 2.6.32 - 3.2 (94%), Linux 3.0 - 3.9 (94%), Linux 3.0 (93%), Linux 2.6.32 - 3.6 (93%), Linux 3.0 - 3.1 (93%), Linux 2.6.38 - 3.0 (93%), Linux 2.6.32 (93%), Linux 2.6.38 - 3.5 (92%)","No exact OS matches for host (test conditions non-ideal).","Network Distance: 18 hops","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 278.52 seconds"]'),
(4, 3, 11, '2014-11-19 16:31:56', '2014-11-19 16:31:56', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-19 16:31 UTC","Initiating Ping Scan at 16:31","Scanning 173.161.209.35 [3 ports]","Completed Ping Scan at 16:31, 1.00s elapsed (1 total hosts)","Initiating SYN Stealth Scan at 16:31","Scanning 173.161.209.35 [1000 ports]","Discovered open port 995/tcp on 173.161.209.35","Discovered open port 993/tcp on 173.161.209.35","Discovered open port 110/tcp on 173.161.209.35","Discovered open port 143/tcp on 173.161.209.35","Discovered open port 53/tcp on 173.161.209.35","Discovered open port 22/tcp on 173.161.209.35","Discovered open port 25/tcp on 173.161.209.35","Discovered open port 8080/tcp on 173.161.209.35","Discovered open port 80/tcp on 173.161.209.35","Increasing send delay for 173.161.209.35 from 0 to 5 due to 33 out of 109 dropped probes since last increase.","Increasing send delay for 173.161.209.35 from 5 to 10 due to 11 out of 34 dropped probes since last increase.","Increasing send delay for 173.161.209.35 from 10 to 20 due to 12 out of 39 dropped probes since last increase.","Increasing send delay for 173.161.209.35 from 20 to 40 due to 11 out of 27 dropped probes since last increase.","Increasing send delay for 173.161.209.35 from 40 to 80 due to 11 out of 25 dropped probes since last increase.","Increasing send delay for 173.161.209.35 from 80 to 160 due to 37 out of 122 dropped probes since last increase.","Increasing send delay for 173.161.209.35 from 160 to 320 due to 11 out of 30 dropped probes since last increase.","SYN Stealth Scan Timing: About 29.88% done; ETC: 16:33 (0:01:13 remaining)","SYN Stealth Scan Timing: About 39.18% done; ETC: 16:34 (0:01:35 remaining)","SYN Stealth Scan Timing: About 63.48% done; ETC: 16:35 (0:01:20 remaining)","SYN Stealth Scan Timing: About 72.78% done; ETC: 16:35 (0:01:03 remaining)","SYN Stealth Scan Timing: About 82.18% done; ETC: 16:36 (0:00:43 remaining)","Completed SYN Stealth Scan at 16:36, 265.36s elapsed (1000 total ports)","Initiating OS detection (try #1) against 173.161.209.35","Retrying OS detection (try #2) against 173.161.209.35","adjust_timeouts2: packet supposedly had rtt of -180978 microseconds.  Ignoring time.","adjust_timeouts2: packet supposedly had rtt of -180978 microseconds.  Ignoring time.","Nmap scan report for 173.161.209.35","Host is up (0.021s latency).","Not shown: 987 closed ports","PORT     STATE    SERVICE","22/tcp   open     ssh","25/tcp   open     smtp","53/tcp   open     domain","80/tcp   open     http","110/tcp  open     pop3","135/tcp  filtered msrpc","139/tcp  filtered netbios-ssn","143/tcp  open     imap","445/tcp  filtered microsoft-ds","993/tcp  open     imaps","995/tcp  open     pop3s","1080/tcp filtered socks","8080/tcp open     http-proxy","Aggressive OS guesses: Linux 2.6.32 - 3.9 (96%), Linux 3.8 (95%), Linux 2.6.32 - 3.2 (94%), Linux 3.0 - 3.9 (93%), Linux 2.6.32 - 3.6 (93%), Linux 2.6.32 (93%), Linux 3.0 (93%), Linux 2.6.38 - 3.0 (92%), Linux 3.2 (92%), Linux 2.6.38 - 3.5 (92%)","No exact OS matches for host (test conditions non-ideal).","Uptime guess: 20.170 days (since Thu Oct 30 12:31:25 2014)","Network Distance: 18 hops","TCP Sequence Prediction: Difficulty=257 (Good luck!)","IP ID Sequence Generation: All zeros","","Read data files from: /usr/bin/../share/nmap","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 271.23 seconds","           Raw packets sent: 1237 (58.138KB) | Rcvd: 1204 (51.966KB)"]'),
(5, 4, 11, '2014-11-24 21:31:48', '2014-11-24 21:31:48', 'c', '["sudo: no tty present and no askpass program specified"]'),
(6, 5, 11, '2014-11-24 23:18:42', '2014-11-24 23:18:42', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-24 23:24 UTC","Note: Host seems down. If it is really up, but blocking our ping probes, try -Pn","Nmap done: 1 IP address (0 hosts up) scanned in 3.33 seconds"]'),
(7, 5, 11, '2014-11-24 23:27:29', '2014-11-24 23:27:29', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-24 23:42 UTC","Note: Host seems down. If it is really up, but blocking our ping probes, try -Pn","Nmap done: 1 IP address (0 hosts up) scanned in 3.32 seconds"]'),
(8, 6, 11, '2014-11-24 23:41:47', '2014-11-24 23:41:47', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-24 23:42 UTC","Note: Host seems down. If it is really up, but blocking our ping probes, try -Pn","Nmap done: 1 IP address (0 hosts up) scanned in 3.31 seconds"]'),
(9, 7, 11, '2014-11-24 23:51:03', '2014-11-24 23:51:03', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-25 19:31 UTC","Nmap scan report for 74.125.228.238","Host is up (0.0014s latency).","Not shown: 98 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","Device type: general purpose|specialized|WAP|media device","Running (JUST GUESSING): OpenBSD 4.X (85%), Crestron 2-Series (85%), Netgear embedded (85%), Western Digital embedded (85%)","OS CPE: cpe:/o:openbsd:openbsd:4.3 cpe:/o:crestron:2_series cpe:/h:netgear:dg834g cpe:/o:westerndigital:wd_tv","Aggressive OS guesses: OpenBSD 4.3 (85%), Crestron XPanel control system (85%), Netgear DG834G WAP or Western Digital WD TV media player (85%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 12.76 seconds"]'),
(10, 8, 11, '2014-11-24 23:51:03', '2014-11-24 23:51:03', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-25 19:31 UTC","Nmap scan report for 74.125.228.233","Host is up (0.0014s latency).","Not shown: 98 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","Device type: general purpose|specialized|WAP|media device","Running (JUST GUESSING): OpenBSD 4.X (91%), Crestron 2-Series (85%), Netgear embedded (85%), Western Digital embedded (85%)","OS CPE: cpe:/o:openbsd:openbsd:4.3 cpe:/o:crestron:2_series cpe:/h:netgear:dg834g cpe:/o:westerndigital:wd_tv","Aggressive OS guesses: OpenBSD 4.3 (91%), Crestron XPanel control system (85%), Netgear DG834G WAP or Western Digital WD TV media player (85%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 7.82 seconds"]'),
(11, 9, 11, '2014-11-25 19:34:11', '2014-11-25 19:34:11', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-11-25 19:34 UTC","Nmap scan report for 208.64.126.226","Host is up (0.067s latency).","Not shown: 997 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","81/tcp  open  hosts2-ns","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","Aggressive OS guesses: OpenWrt Kamikaze 7.09 (Linux 2.6.22) (92%), OpenWrt White Russian 0.9 (Linux 2.4.30) (91%), OpenWrt 0.9 - 7.09 (Linux 2.4.30 - 2.4.34) (91%), Nintendo Wii game console (88%), Linux 2.4.18 (88%), Apple Mac OS X 10.5.8 - 10.6.4 (Leopard - Snow Leopard) (Darwin 9.8.0 - 10.4.0) (88%), Cisco IronPort C650 email security appliance (AsyncOS 7.0.1) (88%), FreeBSD 6.1-RELEASE (88%), FreeBSD 8.0-RELEASE (86%), OpenBSD 4.3 (86%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 12.53 seconds"]'),
(12, 10, 11, '2014-12-10 18:43:50', '2014-12-10 18:43:50', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2014-12-11 19:48 UTC","Initiating Ping Scan at 19:48","Scanning 212.58.246.103 [3 ports]","Completed Ping Scan at 19:48, 1.00s elapsed (1 total hosts)","Initiating SYN Stealth Scan at 19:48","Scanning 212.58.246.103 [1000 ports]","Discovered open port 80/tcp on 212.58.246.103","Discovered open port 443/tcp on 212.58.246.103","Increasing send delay for 212.58.246.103 from 0 to 5 due to 13 out of 43 dropped probes since last increase.","Completed SYN Stealth Scan at 19:48, 3.26s elapsed (1000 total ports)","Initiating OS detection (try #1) against 212.58.246.103","Nmap scan report for 212.58.246.103","Host is up (0.081s latency).","Not shown: 998 closed ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Device type: general purpose","Running: Linux 2.6.X|3.X","OS CPE: cpe:/o:linux:linux_kernel:2.6 cpe:/o:linux:linux_kernel:3","OS details: Linux 2.6.32 - 3.9, Linux 2.6.32 - 3.6","Uptime guess: 28.549 days (since Thu Nov 13 06:38:09 2014)","TCP Sequence Prediction: Difficulty=259 (Good luck!)","IP ID Sequence Generation: All zeros","","Read data files from: /usr/bin/../share/nmap","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 6.57 seconds","           Raw packets sent: 1137 (52.644KB) | Rcvd: 1120 (46.012KB)"]'),
(13, 11, 11, '2015-01-05 22:19:05', '2015-01-05 22:19:05', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-01-05 22:28 UTC","Initiating Ping Scan at 22:28","Scanning 54.173.133.74 [3 ports]","Completed Ping Scan at 22:28, 1.00s elapsed (1 total hosts)","Initiating SYN Stealth Scan at 22:28","Scanning 54.173.133.74 [1000 ports]","Discovered open port 22/tcp on 54.173.133.74","Increasing send delay for 54.173.133.74 from 0 to 5 due to 36 out of 119 dropped probes since last increase.","Increasing send delay for 54.173.133.74 from 5 to 10 due to 12 out of 38 dropped probes since last increase.","Completed SYN Stealth Scan at 22:28, 2.81s elapsed (1000 total ports)","Initiating OS detection (try #1) against 54.173.133.74","Retrying OS detection (try #2) against 54.173.133.74","Retrying OS detection (try #3) against 54.173.133.74","Retrying OS detection (try #4) against 54.173.133.74","Retrying OS detection (try #5) against 54.173.133.74","Nmap scan report for 54.173.133.74","Host is up (0.0015s latency).","Not shown: 999 closed ports","PORT   STATE SERVICE","22/tcp open  ssh","No exact OS matches for host (If you know what OS is running on it, see http://nmap.org/submit/ ).","TCP/IP fingerprint:","OS:SCAN(V=6.40%E=4%D=1/5%OT=22%CT=1%CU=41458%PV=N%DS=2%DC=I%G=Y%TM=54AB102C","OS:%P=x86_64-pc-linux-gnu)SEQ(SP=FB%GCD=1%ISR=111%TI=Z%CI=I%TS=8)OPS(O1=M23","OS:01ST11NW7%O2=M2301ST11NW7%O3=M2301NNT11NW7%O4=M2301ST11NW7%O5=M2301ST11N","OS:W7%O6=M2301ST11)WIN(W1=68DF%W2=68DF%W3=68DF%W4=68DF%W5=68DF%W6=68DF)ECN(","OS:R=Y%DF=Y%T=40%W=6903%O=M2301NNSNW7%CC=Y%Q=)T1(R=Y%DF=Y%T=40%S=O%A=S+%F=A","OS:S%RD=0%Q=)T2(R=N)T3(R=N)T4(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T5(R","OS:=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)T6(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F","OS:=R%O=%RD=0%Q=)T7(R=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)U1(R=Y%DF=N%","OS:T=40%IPL=164%UN=0%RIPL=G%RID=G%RIPCK=G%RUCK=D601%RUD=G)IE(R=Y%DFI=N%T=40","OS:%CD=S)","","Uptime guess: 5.918 days (since Wed Dec 31 00:27:16 2014)","Network Distance: 2 hops","TCP Sequence Prediction: Difficulty=251 (Good luck!)","IP ID Sequence Generation: All zeros","","Read data files from: /usr/bin/../share/nmap","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 17.89 seconds","           Raw packets sent: 1270 (65.370KB) | Rcvd: 1232 (58.174KB)"]'),
(14, 12, 11, '2015-01-05 22:41:12', '2015-01-05 22:41:12', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-01-05 23:00 UTC","Nmap scan report for 54.173.133.74","Host is up (0.0017s latency).","Not shown: 999 closed ports","PORT   STATE SERVICE","22/tcp open  ssh","No exact OS matches for host (If you know what OS is running on it, see http://nmap.org/submit/ ).","TCP/IP fingerprint:","OS:SCAN(V=6.40%E=4%D=1/5%OT=22%CT=1%CU=31787%PV=N%DS=2%DC=I%G=Y%TM=54AB17B1","OS:%P=x86_64-pc-linux-gnu)SEQ(SP=105%GCD=1%ISR=10D%TI=Z%CI=I%TS=8)SEQ(SP=10","OS:5%GCD=1%ISR=10D%TI=Z%CI=I%II=I%TS=8)OPS(O1=M2301ST11NW7%O2=M2301ST11NW7%","OS:O3=M2301NNT11NW7%O4=M2301ST11NW7%O5=M2301ST11NW7%O6=M2301ST11)WIN(W1=68D","OS:F%W2=68DF%W3=68DF%W4=68DF%W5=68DF%W6=68DF)ECN(R=Y%DF=Y%T=40%W=6903%O=M23","OS:01NNSNW7%CC=Y%Q=)T1(R=Y%DF=Y%T=40%S=O%A=S+%F=AS%RD=0%Q=)T2(R=N)T3(R=N)T4","OS:(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T5(R=Y%DF=Y%T=40%W=0%S=Z%A=S+%","OS:F=AR%O=%RD=0%Q=)T6(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T7(R=Y%DF=Y%","OS:T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)U1(R=Y%DF=N%T=40%IPL=164%UN=0%RIPL=G%R","OS:ID=G%RIPCK=G%RUCK=B447%RUD=G)IE(R=Y%DFI=N%T=40%CD=S)","","Network Distance: 2 hops","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 31.66 seconds"]'),
(15, 12, 11, '2015-01-07 20:18:25', '2015-01-07 20:18:25', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-01-07 20:26 UTC","Nmap scan report for 54.173.133.74","Host is up (0.0020s latency).","Not shown: 999 closed ports","PORT   STATE SERVICE","22/tcp open  ssh","No exact OS matches for host (If you know what OS is running on it, see http://nmap.org/submit/ ).","TCP/IP fingerprint:","OS:SCAN(V=6.40%E=4%D=1/7%OT=22%CT=1%CU=34135%PV=N%DS=2%DC=I%G=Y%TM=54AD9679","OS:%P=x86_64-pc-linux-gnu)SEQ(SP=F8%GCD=1%ISR=105%TI=Z%CI=I%TS=8)OPS(O1=M23","OS:01ST11NW7%O2=M2301ST11NW7%O3=M2301NNT11NW7%O4=M2301ST11NW7%O5=M2301ST11N","OS:W7%O6=M2301ST11)WIN(W1=68DF%W2=68DF%W3=68DF%W4=68DF%W5=68DF%W6=68DF)ECN(","OS:R=Y%DF=Y%T=40%W=6903%O=M2301NNSNW7%CC=Y%Q=)T1(R=Y%DF=Y%T=40%S=O%A=S+%F=A","OS:S%RD=0%Q=)T2(R=N)T3(R=N)T4(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T5(R","OS:=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)T6(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F","OS:=R%O=%RD=0%Q=)T7(R=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)U1(R=Y%DF=N%","OS:T=40%IPL=164%UN=0%RIPL=G%RID=G%RIPCK=G%RUCK=C60A%RUD=G)IE(R=Y%DFI=N%T=40","OS:%CD=S)","","Network Distance: 2 hops","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 30.77 seconds"]'),
(16, 13, 4, '2015-06-23 11:10:55', '2015-06-23 11:10:55', 'c', '["sudo: no tty present and no askpass program specified"]'),
(17, 14, 11, '2015-07-06 18:45:54', '2015-07-06 18:45:54', 'c', '["sudo: no tty present and no askpass program specified"]'),
(18, 15, 11, '2015-07-06 18:46:24', '2015-07-06 18:46:24', 'c', '["sudo: no tty present and no askpass program specified"]'),
(19, 16, 11, '2015-07-06 18:46:48', '2015-07-06 18:46:48', 'c', '["sudo: no tty present and no askpass program specified"]'),
(20, 17, 11, '2015-07-06 18:46:56', '2015-07-06 18:46:56', 'c', '["sudo: no tty present and no askpass program specified"]'),
(21, 18, 11, '2015-07-06 18:48:33', '2015-07-06 18:48:33', 'c', '["sudo: no tty present and no askpass program specified"]'),
(22, 19, 11, '2015-07-06 18:48:51', '2015-07-06 18:48:51', 'c', '["sudo: no tty present and no askpass program specified"]'),
(23, 21, 4, '2015-07-20 20:38:45', '2015-07-20 20:38:45', 'c', '["sudo: no tty present and no askpass program specified"]'),
(24, 22, 4, '2015-08-05 07:14:41', '2015-08-05 07:14:41', 'c', '["sudo: no tty present and no askpass program specified"]'),
(25, 23, 4, '2015-08-05 07:14:43', '2015-08-05 07:14:43', 'c', '["sudo: no tty present and no askpass program specified"]'),
(26, 24, 4, '2015-08-05 09:14:01', '2015-08-05 09:14:01', 'c', '["sudo: no tty present and no askpass program specified"]'),
(27, 25, 4, '2015-08-05 09:30:06', '2015-08-05 09:30:06', 'c', '["sudo: no tty present and no askpass program specified"]'),
(28, 13, 4, '2015-08-05 09:30:33', '2015-08-05 09:30:33', 'c', '["sudo: no tty present and no askpass program specified"]'),
(29, 26, 4, '2015-08-05 09:31:23', '2015-08-05 09:31:23', 'c', '["sudo: no tty present and no askpass program specified"]'),
(30, 27, 4, '2015-08-05 11:57:20', '2015-08-05 11:57:20', 'c', '["sudo: no tty present and no askpass program specified"]'),
(31, 28, 4, '2015-08-05 13:25:54', '2015-08-05 13:25:54', 'c', '["sudo: no tty present and no askpass program specified"]'),
(32, 29, 4, '2015-08-05 13:31:29', '2015-08-05 13:31:29', 'c', '["sudo: no tty present and no askpass program specified"]'),
(33, 30, 4, '2015-08-05 13:32:59', '2015-08-05 13:32:59', 'c', '["sudo: no tty present and no askpass program specified"]'),
(34, 1, 4, '2015-08-05 13:33:42', '2015-08-05 13:33:42', 'c', '["sudo: no tty present and no askpass program specified"]'),
(35, 31, 4, '2015-08-05 13:33:59', '2015-08-05 13:33:59', 'c', '["sudo: no tty present and no askpass program specified"]'),
(36, 32, 4, '2015-08-05 14:00:29', '2015-08-05 14:00:29', 'c', '["sudo: no tty present and no askpass program specified"]'),
(37, 31, 4, '2015-08-05 15:01:12', '2015-08-05 15:01:12', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:01 UTC","Nmap scan report for 173.194.206.86","Host is up (0.0090s latency).","Not shown: 998 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","OS fingerprint not ideal because: Missing a closed TCP port so results incomplete","No OS matches for host","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 16.69 seconds"]'),
(38, 31, 4, '2015-08-05 15:01:31', '2015-08-05 15:01:31', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:01 UTC","Nmap scan report for 173.194.206.86","Host is up (0.0091s latency).","Not shown: 998 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","OS fingerprint not ideal because: Missing a closed TCP port so results incomplete","No OS matches for host","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 25.01 seconds"]'),
(39, 31, 4, '2015-08-05 15:01:31', '2015-08-05 15:01:31', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:02 UTC","Nmap scan report for 173.194.206.86","Host is up (0.0093s latency).","Not shown: 998 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","OS fingerprint not ideal because: Missing a closed TCP port so results incomplete","No OS matches for host","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 24.41 seconds"]'),
(40, 31, 4, '2015-08-05 15:01:32', '2015-08-05 15:01:32', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:02 UTC","Nmap scan report for 173.194.206.86","Host is up (0.0090s latency).","Not shown: 998 filtered ports","PORT    STATE SERVICE","80/tcp  open  http","443/tcp open  https","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","OS fingerprint not ideal because: Missing a closed TCP port so results incomplete","No OS matches for host","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 23.77 seconds"]'),
(41, 33, 4, '2015-08-05 15:02:55', '2015-08-05 15:02:55', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:02 UTC","Nmap scan report for 104.16.103.85","Host is up (0.00093s latency).","Not shown: 996 filtered ports","PORT     STATE SERVICE","80/tcp   open  http","443/tcp  open  https","8080/tcp open  http-proxy","8443/tcp open  https-alt","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","Aggressive OS guesses: Crestron XPanel control system (89%), Netgear DG834G WAP or Western Digital WD TV media player (89%), Linux 3.2 (88%), OpenWrt White Russian 0.9 (Linux 2.4.30) (87%), OpenWrt 0.9 - 7.09 (Linux 2.4.30 - 2.4.34) (87%), OpenWrt Kamikaze 7.09 (Linux 2.6.22) (87%), HP P2000 G3 NAS device (86%), Linux 3.1 (86%), Linux 2.6.32 (86%), AXIS 210A or 211 Network Camera (Linux 2.6) (86%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 24.98 seconds"]'),
(42, 34, 11, '2015-08-05 15:05:36', '2015-08-05 15:05:36', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:05 UTC","Nmap scan report for 54.172.144.121","Host is up (0.0038s latency).","Not shown: 996 closed ports","PORT    STATE SERVICE","22/tcp  open  ssh","25/tcp  open  smtp","80/tcp  open  http","111/tcp open  rpcbind","No exact OS matches for host (If you know what OS is running on it, see http://nmap.org/submit/ ).","TCP/IP fingerprint:","OS:SCAN(V=6.40%E=4%D=8/5%OT=22%CT=1%CU=33583%PV=N%DS=2%DC=I%G=Y%TM=55C22661","OS:%P=x86_64-pc-linux-gnu)SEQ(SP=100%GCD=1%ISR=109%TI=Z%CI=I%TS=8)SEQ(SP=10","OS:0%GCD=1%ISR=109%TI=Z%CI=I%II=I%TS=8)OPS(O1=M2301ST11NW7%O2=M2301ST11NW7%","OS:O3=M2301NNT11NW7%O4=M2301ST11NW7%O5=M2301ST11NW7%O6=M2301ST11)WIN(W1=68D","OS:F%W2=68DF%W3=68DF%W4=68DF%W5=68DF%W6=68DF)ECN(R=Y%DF=Y%T=40%W=6903%O=M23","OS:01NNSNW7%CC=Y%Q=)T1(R=Y%DF=Y%T=40%S=O%A=S+%F=AS%RD=0%Q=)T2(R=N)T3(R=N)T4","OS:(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T5(R=Y%DF=Y%T=40%W=0%S=Z%A=S+%","OS:F=AR%O=%RD=0%Q=)T6(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T7(R=Y%DF=Y%","OS:T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)U1(R=Y%DF=N%T=40%IPL=164%UN=0%RIPL=G%R","OS:ID=G%RIPCK=G%RUCK=G%RUD=G)IE(R=Y%DFI=N%T=40%CD=S)","","Network Distance: 2 hops","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 32.25 seconds"]'),
(43, 35, 4, '2015-08-05 15:28:43', '2015-08-05 15:28:43', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:28 UTC","Nmap scan report for 72.52.91.14","Host is up (0.068s latency).","Not shown: 997 filtered ports","PORT     STATE  SERVICE","80/tcp   open   http","443/tcp  open   https","8001/tcp closed vcom-tunnel","Aggressive OS guesses: Netgear DG834G WAP or Western Digital WD TV media player (93%), Linux 2.6.32 (93%), Linux 2.6.32 - 3.9 (93%), Crestron XPanel control system (92%), Linux 2.6.32 - 3.6 (92%), Linux 3.8 (91%), Linux 2.6.32 - 2.6.35 (89%), Linux 2.6.32 - 3.2 (89%), Linux 2.6.38 - 3.5 (89%), Linux 3.1 (89%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 15.57 seconds"]'),
(44, 36, 4, '2015-08-05 15:29:59', '2015-08-05 15:29:59', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 15:29 UTC","Note: Host seems down. If it is really up, but blocking our ping probes, try -Pn","Nmap done: 1 IP address (0 hosts up) scanned in 3.33 seconds"]'),
(45, 37, 4, '2015-08-05 18:11:07', '2015-08-05 18:11:07', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 18:11 UTC","Nmap scan report for 199.83.132.38","Host is up (0.0010s latency).","Not shown: 905 filtered ports","PORT      STATE SERVICE","25/tcp    open  smtp","53/tcp    open  domain","80/tcp    open  http","81/tcp    open  hosts2-ns","82/tcp    open  xfer","83/tcp    open  mit-ml-dev","85/tcp    open  mit-ml-dev","88/tcp    open  kerberos-sec","389/tcp   open  ldap","443/tcp   open  https","444/tcp   open  snpp","555/tcp   open  dsf","636/tcp   open  ldapssl","800/tcp   open  mdbs_daemon","801/tcp   open  device","843/tcp   open  unknown","1000/tcp  open  cadlock","1111/tcp  open  lmsocialserver","1234/tcp  open  hotline","1494/tcp  open  citrix-ica","1935/tcp  open  rtmp","2000/tcp  open  cisco-sccp","2006/tcp  open  invokator","2048/tcp  open  dls-monitor","2049/tcp  open  nfs","2068/tcp  open  advocentkvm","2100/tcp  open  amiganetfs","2200/tcp  open  ici","2222/tcp  open  EtherNet/IP-1","2557/tcp  open  nicetec-mgmt","3030/tcp  open  arepa-cas","3052/tcp  open  powerchute","3333/tcp  open  dec-notes","3551/tcp  open  apcupsd","4000/tcp  open  remoteanything","4001/tcp  open  newoak","4343/tcp  open  unicall","4443/tcp  open  pharos","5000/tcp  open  upnp","5001/tcp  open  commplex-link","5222/tcp  open  xmpp-client","5280/tcp  open  xmpp-bosh","6000/tcp  open  X11","6002/tcp  open  X11:2","6100/tcp  open  synchronet-db","6510/tcp  open  mcer-port","6580/tcp  open  parsec-master","6789/tcp  open  ibm-db2-admin","7000/tcp  open  afs3-fileserver","7001/tcp  open  afs3-callback","7002/tcp  open  afs3-prserver","7004/tcp  open  afs3-kaserver","7070/tcp  open  realserver","7777/tcp  open  cbt","8000/tcp  open  http-alt","8001/tcp  open  vcom-tunnel","8002/tcp  open  teradataordbms","8031/tcp  open  unknown","8080/tcp  open  http-proxy","8081/tcp  open  blackice-icecap","8082/tcp  open  blackice-alerts","8083/tcp  open  us-srv","8084/tcp  open  unknown","8085/tcp  open  unknown","8086/tcp  open  d-s-n","8087/tcp  open  simplifymedia","8088/tcp  open  radan-http","8089/tcp  open  unknown","8090/tcp  open  unknown","8093/tcp  open  unknown","8100/tcp  open  xprint-server","8200/tcp  open  trivnet1","8443/tcp  open  https-alt","8888/tcp  open  sun-answerbook","9000/tcp  open  cslistener","9001/tcp  open  tor-orport","9002/tcp  open  dynamid","9080/tcp  open  glrpc","9090/tcp  open  zeus-admin","9091/tcp  open  xmltec-xmlmail","9099/tcp  open  unknown","9100/tcp  open  jetdirect","9101/tcp  open  jetdirect","9102/tcp  open  jetdirect","9103/tcp  open  jetdirect","9110/tcp  open  unknown","9111/tcp  open  DragonIDSConsole","9200/tcp  open  wap-wsp","9207/tcp  open  wap-vcal-s","9220/tcp  open  unknown","10000/tcp open  snet-sensor-mgmt","16000/tcp open  fmsas","20000/tcp open  dnp","50000/tcp open  ibm-db2","60443/tcp open  unknown","Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port","Device type: general purpose|specialized|WAP|media device|storage-misc","Running (JUST GUESSING): Linux 2.6.X|3.X (93%), Crestron 2-Series (87%), Netgear embedded (87%), Western Digital embedded (87%), Google Android 4.X (85%), HP embedded (85%)","OS CPE: cpe:/o:linux:linux_kernel:2.6 cpe:/o:linux:linux_kernel:3 cpe:/o:crestron:2_series cpe:/h:netgear:dg834g cpe:/o:westerndigital:wd_tv cpe:/o:google:android:4 cpe:/h:hp:p2000_g3","Aggressive OS guesses: Linux 2.6.26 - 2.6.35 (93%), Linux 2.6.32 - 3.6 (93%), Linux 3.0 (93%), Linux 2.6.32 (93%), Linux 2.6.32 - 3.9 (92%), Linux 3.0 - 3.9 (92%), Linux 2.6.23 - 2.6.38 (89%), Linux 3.8 (89%), Crestron XPanel control system (87%), Netgear DG834G WAP or Western Digital WD TV media player (87%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 78.89 seconds"]'),
(46, 38, 4, '2015-08-05 18:23:50', '2015-08-05 18:23:50', 'c', '["","Starting Nmap 6.40 ( http://nmap.org ) at 2015-08-05 18:23 UTC","Nmap scan report for 202.87.58.26","Host is up (0.18s latency).","Not shown: 998 filtered ports","PORT    STATE  SERVICE","80/tcp  open   http","443/tcp closed https","Device type: general purpose","Running (JUST GUESSING): OpenBSD 4.X (86%)","OS CPE: cpe:/o:openbsd:openbsd:4.3","Aggressive OS guesses: OpenBSD 4.3 (86%), OpenBSD 4.0 (85%)","No exact OS matches for host (test conditions non-ideal).","","OS detection performed. Please report any incorrect results at http://nmap.org/submit/ .","Nmap done: 1 IP address (1 host up) scanned in 22.90 seconds"]');

-- --------------------------------------------------------

--
-- Table structure for table `host_services`
--

CREATE TABLE IF NOT EXISTS `host_services` (
  `id` double NOT NULL,
  `host_id` double NOT NULL,
  `service_id` double NOT NULL,
  `site_main_host_id` double NOT NULL,
  `nconf_host_id` double NOT NULL,
  `nconf_service_id` double NOT NULL,
  `nconf_main_service_id` double NOT NULL,
  `added_date` datetime NOT NULL,
  `user_id` double NOT NULL,
  `status` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_services`
--

INSERT INTO `host_services` (`id`, `host_id`, `service_id`, `site_main_host_id`, `nconf_host_id`, `nconf_service_id`, `nconf_main_service_id`, `added_date`, `user_id`, `status`) VALUES
(1, 0, 50, 0, 1, 5731, 5241, '2015-08-06 16:29:01', 4, 'y'),
(2, 0, 51, 0, 1, 5732, 5246, '2015-08-06 16:29:01', 4, 'y'),
(3, 0, 52, 0, 1, 5735, 5241, '2015-08-06 17:07:38', 4, 'y'),
(4, 0, 53, 0, 1, 5737, 5244, '2015-08-06 17:48:55', 11, 'y'),
(5, 0, 54, 0, 1, 5738, 5250, '2015-08-06 17:48:55', 11, 'y'),
(6, 2, 55, 2, 5733, 5739, 5250, '2015-08-07 20:14:26', 4, 'y'),
(7, 0, 56, 0, 1, 5742, 5241, '2015-08-08 09:11:03', 4, 'y'),
(8, 0, 57, 0, 1, 5744, 5252, '2015-08-08 12:41:14', 4, 'y'),
(9, 8, 58, 7, 5743, 5745, 5252, '2015-08-08 12:41:48', 4, 'y'),
(10, 8, 59, 7, 5743, 5746, 5246, '2015-08-08 12:41:48', 4, 'y'),
(11, 11, 60, 9, 5748, 5749, 5241, '2015-08-10 15:19:50', 11, 'y'),
(12, 11, 61, 9, 5748, 5750, 5244, '2015-08-10 15:19:50', 11, 'y'),
(13, 11, 62, 9, 5748, 5751, 5246, '2015-08-10 15:19:50', 11, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `host_user`
--

CREATE TABLE IF NOT EXISTS `host_user` (
  `id` double NOT NULL,
  `site_main_host_id` double NOT NULL,
  `host_alias` varchar(200) NOT NULL,
  `host_name` varchar(200) NOT NULL,
  `host_ip` varchar(200) NOT NULL,
  `host_os` double NOT NULL,
  `host_preset` double NOT NULL,
  `tcp_port` varchar(100) NOT NULL,
  `multiple_options` varchar(200) NOT NULL,
  `user_id` double NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` enum('y','n') NOT NULL COMMENT 'y=yes,n=no',
  `ipaddress` varchar(200) NOT NULL,
  `setup_status` enum('y','n') NOT NULL DEFAULT 'n',
  `notifications_emails_number` int(11) NOT NULL,
  `notifications_emails_count` int(11) NOT NULL,
  `last_notification_date` date NOT NULL,
  `tcp_attr_flag` enum('y','n') NOT NULL,
  `udp_port` varchar(100) NOT NULL,
  `udp_attr_flag` enum('y','n') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_user`
--

INSERT INTO `host_user` (`id`, `site_main_host_id`, `host_alias`, `host_name`, `host_ip`, `host_os`, `host_preset`, `tcp_port`, `multiple_options`, `user_id`, `created`, `updated`, `status`, `ipaddress`, `setup_status`, `notifications_emails_number`, `notifications_emails_count`, `last_notification_date`, `tcp_attr_flag`, `udp_port`, `udp_attr_flag`) VALUES
(1, 1, 'google.com', 'http://google.com', '216.58.219.206', 0, 0, '', '', 4, '2015-08-06 16:28:50', '2015-08-06 16:28:50', 'y', '150.129.150.52', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(2, 2, 'facebook.com', 'http://facebook.com', '31.13.90.2', 0, 0, '80', '', 4, '2015-08-06 16:34:03', '2015-08-06 16:41:35', 'y', '150.129.150.52', 'n', 1, 0, '0000-00-00', 'n', '', 'n'),
(3, 3, 'Yahoo.com', 'http://Yahoo.com', '98.138.253.109', 0, 0, '', '', 4, '2015-08-06 16:41:57', '2015-08-06 16:41:57', 'y', '150.129.150.52', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(4, 3, 'Yahoo.com', 'http://Yahoo.com', '98.138.253.109', 0, 0, '', '', 4, '2015-08-06 16:49:15', '2015-08-06 16:49:15', 'y', '150.129.150.52', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(5, 4, 'google.com', 'http://www.google.com', '74.125.228.230', 0, 0, '', '', 11, '2015-08-06 17:48:18', '2015-08-06 17:48:18', 'y', '64.58.67.6', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(6, 5, 'timesofindia.com', 'http://timesofindia.com', '223.165.25.18', 0, 0, '', '', 4, '2015-08-07 20:42:52', '2015-08-07 20:42:52', 'y', '1.23.189.115', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(7, 6, 'netispy.com', 'http://netispy.com', '119.18.57.101', 0, 0, '', '', 4, '2015-08-08 09:09:41', '2015-08-08 09:09:41', 'y', '150.129.150.163', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(8, 7, 'trello.com', 'http://trello.com', '185.11.124.4', 0, 0, '', '', 4, '2015-08-08 12:25:16', '2015-08-08 12:25:16', 'y', '150.129.150.163', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(9, 8, 'bookmyshow.com', 'http://bookmyshow.com', '54.231.243.137', 0, 0, '', '', 4, '2015-08-09 06:20:04', '2015-08-09 06:20:04', 'y', '150.129.150.212', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(10, 9, 'dimatas.com', 'http://dimatas.com', '54.172.144.121', 0, 0, '', '', 11, '2015-08-10 15:05:54', '2015-08-10 15:05:54', 'y', '64.58.67.6', 'n', 0, 0, '0000-00-00', 'n', '', 'n'),
(11, 9, 'dimatas.com', 'http://dimatas.com', '54.172.144.121', 0, 0, '', '', 11, '2015-08-10 15:13:01', '2015-08-10 15:13:01', 'y', '64.58.67.6', 'n', 0, 0, '0000-00-00', 'n', '', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `host_user_email`
--

CREATE TABLE IF NOT EXISTS `host_user_email` (
  `id` double NOT NULL,
  `host_id` double NOT NULL,
  `user_id` double NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_user_email`
--

INSERT INTO `host_user_email` (`id`, `host_id`, `user_id`, `email`) VALUES
(1, 2, 4, 'manan.jobanputra@gmail.com'),
(2, 3, 4, 'manan.jobanputra@gmail.com'),
(3, 4, 4, 'manan.jobanputra@gmail.com'),
(4, 7, 4, 'manan.jobanputra@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE IF NOT EXISTS `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `ipaddress` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scan_options`
--

CREATE TABLE IF NOT EXISTS `scan_options` (
  `id` double NOT NULL,
  `scan_id` double NOT NULL,
  `option_field` text NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  `option_extra` text NOT NULL,
  `option_extra_value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan_options`
--

INSERT INTO `scan_options` (`id`, `scan_id`, `option_field`, `option_name`, `option_value`, `option_extra`, `option_extra_value`) VALUES
(1, 1, 'scantype', 'TCP SYN', '-sS ', '', ''),
(2, 1, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(3, 1, 'option1', 'OS Fingerprint', '-O ', '', ''),
(4, 1, 'option4', 'Standard Verbosity', '', '', ''),
(5, 1, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(6, 1, 'timing', 'Normal', '-T Normal ', '', ''),
(94, 16, 'scantype', 'TCP SYN', '-sS ', '', ''),
(95, 16, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(96, 16, 'option1', 'OS Fingerprint', '-O ', '', ''),
(97, 16, 'option4', 'Standard Verbosity', '', '', ''),
(98, 16, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(99, 16, 'timing', 'Normal', '-T Normal ', '', ''),
(106, 18, 'scantype', 'TCP SYN', '-sS ', '', ''),
(107, 18, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(108, 18, 'option1', 'OS Fingerprint', '-O ', '', ''),
(109, 18, 'option4', 'Standard Verbosity', '', '', ''),
(110, 18, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(111, 18, 'timing', 'Normal', '-T Normal ', '', ''),
(112, 19, 'scantype', 'TCP SYN', '-sS ', '', ''),
(113, 19, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(114, 19, 'option1', 'OS Fingerprint', '-O ', '', ''),
(115, 19, 'option4', 'Standard Verbosity', '', '', ''),
(116, 19, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(117, 19, 'timing', 'Normal', '-T Normal ', '', ''),
(118, 23, 'scantype', 'TCP SYN', '-sS ', '', ''),
(119, 23, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(120, 23, 'option1', 'OS Fingerprint', '-O ', '', ''),
(121, 23, 'option4', 'Standard Verbosity', '', '', ''),
(122, 23, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(123, 23, 'timing', 'Normal', '-T Normal ', '', ''),
(124, 24, 'scantype', 'TCP SYN', '-sS ', '', ''),
(125, 24, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(126, 24, 'option1', 'OS Fingerprint', '-O ', '', ''),
(127, 24, 'option4', 'Standard Verbosity', '', '', ''),
(128, 24, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(129, 24, 'timing', 'Normal', '-T Normal ', '', ''),
(130, 25, 'scantype', 'TCP SYN', '-sS ', '', ''),
(131, 25, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(132, 25, 'option1', 'OS Fingerprint', '-O ', '', ''),
(133, 25, 'option4', 'Standard Verbosity', '', '', ''),
(134, 25, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(135, 25, 'timing', 'Normal', '-T Normal ', '', ''),
(136, 26, 'scantype', 'TCP SYN', '-sS ', '', ''),
(137, 26, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(138, 26, 'option1', 'OS Fingerprint', '-O ', '', ''),
(139, 26, 'option4', 'Standard Verbosity', '', '', ''),
(140, 26, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(141, 26, 'timing', 'Normal', '-T Normal ', '', ''),
(142, 27, 'scantype', 'TCP SYN', '-sS ', '', ''),
(143, 27, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(144, 27, 'option1', 'OS Fingerprint', '-O ', '', ''),
(145, 27, 'option4', 'Standard Verbosity', '', '', ''),
(146, 27, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(147, 27, 'timing', 'Normal', '-T Normal ', '', ''),
(148, 28, 'scantype', 'TCP SYN', '-sS ', '', ''),
(149, 28, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(150, 28, 'option1', 'OS Fingerprint', '-O ', '', ''),
(151, 28, 'option4', 'Standard Verbosity', '', '', ''),
(152, 28, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(153, 28, 'timing', 'Normal', '-T Normal ', '', ''),
(154, 29, 'scantype', 'TCP SYN', '-sS ', '', ''),
(155, 29, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(156, 29, 'option1', 'OS Fingerprint', '-O ', '', ''),
(157, 29, 'option4', 'Standard Verbosity', '', '', ''),
(158, 29, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(159, 29, 'timing', 'Normal', '-T Normal ', '', ''),
(160, 30, 'scantype', 'TCP SYN', '-sS ', '', ''),
(161, 30, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(162, 30, 'option1', 'OS Fingerprint', '-O ', '', ''),
(163, 30, 'option4', 'Standard Verbosity', '', '', ''),
(164, 30, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(165, 30, 'timing', 'Normal', '-T Normal ', '', ''),
(166, 31, 'scantype', 'TCP SYN', '-sS ', '', ''),
(167, 31, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(168, 31, 'option1', 'OS Fingerprint', '-O ', '', ''),
(169, 31, 'option4', 'Standard Verbosity', '', '', ''),
(170, 31, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(171, 31, 'timing', 'Normal', '-T Normal ', '', ''),
(172, 32, 'scantype', 'TCP SYN', '-sS ', '', ''),
(173, 32, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(174, 32, 'option1', 'OS Fingerprint', '-O ', '', ''),
(175, 32, 'option4', 'Standard Verbosity', '', '', ''),
(176, 32, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(177, 32, 'timing', 'Normal', '-T Normal ', '', ''),
(178, 33, 'scantype', 'TCP SYN', '-sS ', '', ''),
(179, 33, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(180, 33, 'option1', 'OS Fingerprint', '-O ', '', ''),
(181, 33, 'option4', 'Standard Verbosity', '', '', ''),
(182, 33, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(183, 33, 'timing', 'Normal', '-T Normal ', '', ''),
(184, 34, 'scantype', 'TCP SYN', '-sS ', '', ''),
(185, 34, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(186, 34, 'option1', 'OS Fingerprint', '-O ', '', ''),
(187, 34, 'option4', 'Standard Verbosity', '', '', ''),
(188, 34, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(189, 34, 'timing', 'Normal', '-T Normal ', '', ''),
(190, 35, 'scantype', 'TCP SYN', '-sS ', '', ''),
(191, 35, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(192, 35, 'option1', 'OS Fingerprint', '-O ', '', ''),
(193, 35, 'option4', 'Standard Verbosity', '', '', ''),
(194, 35, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(195, 35, 'timing', 'Normal', '-T Normal ', '', ''),
(196, 36, 'scantype', 'TCP SYN', '-sS ', '', ''),
(197, 36, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(198, 36, 'option1', 'OS Fingerprint', '-O ', '', ''),
(199, 36, 'option4', 'Standard Verbosity', '', '', ''),
(200, 36, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(201, 36, 'timing', 'Normal', '-T Normal ', '', ''),
(202, 37, 'scantype', 'TCP SYN', '-sS ', '', ''),
(203, 37, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(204, 37, 'option1', 'OS Fingerprint', '-O ', '', ''),
(205, 37, 'option4', 'Standard Verbosity', '', '', ''),
(206, 37, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(207, 37, 'timing', 'Normal', '-T Normal ', '', ''),
(208, 38, 'scantype', 'TCP SYN', '-sS ', '', ''),
(209, 38, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(210, 38, 'option1', 'OS Fingerprint', '-O ', '', ''),
(211, 38, 'option4', 'Standard Verbosity', '', '', ''),
(212, 38, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(213, 38, 'timing', 'Normal', '-T Normal ', '', ''),
(214, 39, 'scantype', 'TCP SYN', '-sS ', '', ''),
(215, 39, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(216, 39, 'option1', 'OS Fingerprint', '-O ', '', ''),
(217, 39, 'option4', 'Standard Verbosity', '', '', ''),
(218, 39, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(219, 39, 'timing', 'Normal', '-T Normal ', '', ''),
(220, 40, 'scantype', 'TCP SYN', '-sS ', '', ''),
(221, 40, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(222, 40, 'option1', 'OS Fingerprint', '-O ', '', ''),
(223, 40, 'option4', 'Standard Verbosity', '', '', ''),
(224, 40, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(225, 40, 'timing', 'Normal', '-T Normal ', '', ''),
(226, 41, 'scantype', 'TCP SYN', '-sS ', '', ''),
(227, 41, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(228, 41, 'option1', 'OS Fingerprint', '-O ', '', ''),
(229, 41, 'option4', 'Standard Verbosity', '', '', ''),
(230, 41, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(231, 41, 'timing', 'Normal', '-T Normal ', '', ''),
(232, 42, 'scantype', 'TCP SYN', '-sS ', '', ''),
(233, 42, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(234, 42, 'option1', 'OS Fingerprint', '-O ', '', ''),
(235, 42, 'option4', 'Standard Verbosity', '', '', ''),
(236, 42, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(237, 42, 'timing', 'Normal', '-T Normal ', '', ''),
(238, 43, 'scantype', 'TCP SYN', '-sS ', '', ''),
(239, 43, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(240, 43, 'option1', 'OS Fingerprint', '-O ', '', ''),
(241, 43, 'option4', 'Standard Verbosity', '', '', ''),
(242, 43, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(243, 43, 'timing', 'Normal', '-T Normal ', '', ''),
(244, 44, 'scantype', 'TCP SYN', '-sS ', '', ''),
(245, 44, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(246, 44, 'option1', 'OS Fingerprint', '-O ', '', ''),
(247, 44, 'option4', 'Standard Verbosity', '', '', ''),
(248, 44, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(249, 44, 'timing', 'Normal', '-T Normal ', '', ''),
(250, 45, 'scantype', 'TCP SYN', '-sS ', '', ''),
(251, 45, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(252, 45, 'option1', 'OS Fingerprint', '-O ', '', ''),
(253, 45, 'option4', 'Standard Verbosity', '', '', ''),
(254, 45, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(255, 45, 'timing', 'Normal', '-T Normal ', '', ''),
(256, 46, 'scantype', 'TCP SYN', '-sS ', '', ''),
(257, 46, 'pingtype1', 'TCP + ICMP echo request', '-PB ', '', ''),
(258, 46, 'option1', 'OS Fingerprint', '-O ', '', ''),
(259, 46, 'option4', 'Standard Verbosity', '', '', ''),
(260, 46, 'option6', 'Do not resolve DNS', '-n ', '', ''),
(261, 46, 'timing', 'Normal', '-T Normal ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` double NOT NULL,
  `service_alias` varchar(255) NOT NULL,
  `nconf_service_id` double NOT NULL,
  `nconf_main_service_id` double NOT NULL,
  `nconf_host_id` double NOT NULL,
  `site_main_host_id` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_alias`, `nconf_service_id`, `nconf_main_service_id`, `nconf_host_id`, `site_main_host_id`) VALUES
(11, 'check_ping', 5755, 5246, 5754, 3),
(12, 'check_smtp', 5756, 5249, 5754, 3),
(13, 'check_snmp', 5757, 5243, 5754, 3),
(14, 'check_tcp', 5758, 5250, 5754, 3),
(17, 'check_udp_2', 5764, 5251, 5754, 3),
(18, 'check_ping', 5766, 5246, 5765, 5),
(19, 'check_pop', 5767, 5247, 5765, 5),
(20, 'check_tcp', 5768, 5250, 5765, 5),
(21, 'check_udp', 5769, 5251, 5765, 5),
(22, 'check_tcp', 5771, 5250, 5770, 6),
(23, 'check_udp', 5772, 5251, 5770, 6),
(24, 'check_tcp', 5774, 5250, 5773, 7),
(25, 'check_udp', 5775, 5251, 5773, 7),
(26, 'check_ftp', 5800, 5241, 5799, 8),
(27, 'check_hpjd', 5801, 5242, 5799, 8),
(45, 'check_ping', 5717, 5246, 5716, 14),
(46, 'check_tcp', 5718, 5250, 5716, 14),
(47, 'check_ftp_4', 5723, 5241, 1, 0),
(48, 'check_hpjd_2', 5724, 5242, 1, 0),
(49, 'check_tcp_2', 5725, 5250, 1, 0),
(50, 'check_ftp_5', 5731, 5241, 1, 0),
(51, 'check_ping_4', 5732, 5246, 1, 0),
(52, 'check_ftp_6', 5735, 5241, 1, 0),
(53, 'check_http_4', 5737, 5244, 1, 0),
(54, 'check_tcp_3', 5738, 5250, 1, 0),
(55, 'check_tcp', 5739, 5250, 5733, 2),
(56, 'check_ftp_7', 5742, 5241, 1, 0),
(57, 'check_nt', 5744, 5252, 1, 0),
(58, 'check_nt', 5745, 5252, 5743, 7),
(59, 'check_ping', 5746, 5246, 5743, 7),
(60, 'check_ftp', 5749, 5241, 5748, 9),
(61, 'check_http', 5750, 5244, 5748, 9),
(62, 'check_ping', 5751, 5246, 5748, 9);

-- --------------------------------------------------------

--
-- Table structure for table `simplyportscan_hosts`
--

CREATE TABLE IF NOT EXISTS `simplyportscan_hosts` (
  `id` double NOT NULL,
  `user_id` double NOT NULL,
  `host_alias` varchar(200) NOT NULL,
  `host_name` varchar(200) NOT NULL,
  `host_ip` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simplyportscan_hosts`
--

INSERT INTO `simplyportscan_hosts` (`id`, `user_id`, `host_alias`, `host_name`, `host_ip`) VALUES
(1, 4, 'gmail.com', 'gmail.com', '74.125.228.85'),
(13, 4, 'google.com', 'google.com', '74.125.141.102'),
(15, 11, 'cnn.com', 'cnn.com', '157.166.226.26'),
(16, 11, 'reuters.com', 'reuters.com', '206.132.6.134'),
(20, 11, 'google.com', 'http://www.google.com', '173.161.209.33'),
(21, 4, 'google.com', 'google.com', '74.125.228.206'),
(22, 4, 'facebook.com', 'facebook.com', '173.252.120.6'),
(23, 4, 'facebook.com', 'facebook.com', '173.252.120.6'),
(24, 4, 'facebook.com', 'facebook.com', '173.252.120.6'),
(25, 4, 'facebook.com', 'facebook.com', '173.252.120.6'),
(26, 4, 'yahoo.com', 'yahoo.com', '98.139.183.24'),
(27, 4, 'soundcloud.com', 'soundcloud.com', '72.21.91.127'),
(28, 4, 'myspace.com', 'myspace.com', '63.135.90.70'),
(29, 4, 'inbox.com', 'inbox.com', '64.135.77.80'),
(30, 4, 'inbox.com', 'inbox.com', '64.135.77.80'),
(31, 4, 'orkut.com', 'orkut.com', '173.194.206.86'),
(32, 4, 'twitter.com', 'twitter.com', '199.16.156.230'),
(33, 4, 'stackoverflow.com', 'stackoverflow.com', '104.16.103.85'),
(34, 11, 'dimatas.com', 'dimatas.com', '54.172.144.121'),
(35, 4, 'php.net', 'php.net', '72.52.91.14'),
(36, 4, 'phpmyadmin.com', 'phpmyadmin.com', '69.172.201.208'),
(37, 4, 'travelguru.com', 'travelguru.com', '199.83.132.38'),
(38, 4, 'yatra.com', 'yatra.com', '202.87.58.26');

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE IF NOT EXISTS `site_config` (
  `id` double NOT NULL,
  `config_status` enum('y','n') NOT NULL COMMENT 'y=yes,n=no',
  `last_updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL,
  `facebook` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `twitter` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `google` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `youtube` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `skype` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `linkedin` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `dribble` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `github` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `dropbox` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `email` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `phone` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `top_panel` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'y=yes;n=no',
  `facebook_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `google_link` varchar(255) NOT NULL,
  `youtube_link` char(255) NOT NULL,
  `skype_link` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL,
  `dribble_link` varchar(255) NOT NULL,
  `github_link` varchar(255) NOT NULL,
  `dropbox_link` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `facebook`, `twitter`, `google`, `youtube`, `skype`, `linkedin`, `dribble`, `github`, `dropbox`, `email`, `phone`, `top_panel`, `facebook_link`, `twitter_link`, `google_link`, `youtube_link`, `skype_link`, `linkedin_link`, `dribble_link`, `github_link`, `dropbox_link`, `email_address`, `phone_number`) VALUES
(1, 'y', 'y', 'y', 'y', 'y', 'y', 'n', 'y', 'y', 'y', 'y', 'y', '#', '#', '#', '#', '#', '#', '#', '#', '#', 'info@dimatas.com', '917-546-9088');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE IF NOT EXISTS `theme_settings` (
  `id` int(10) NOT NULL,
  `front_color` enum('blue','green','orange','red') NOT NULL,
  `admin_color` enum('blue','brown','default','grey','light','purple') NOT NULL,
  `dashboard_color` enum('blue','brown','default','grey','light','purple') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `front_color`, `admin_color`, `dashboard_color`) VALUES
(1, 'blue', 'light', 'light');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `type` enum('a','u') NOT NULL DEFAULT 'u' COMMENT 'a=admin,u=user',
  `status` enum('a','d') NOT NULL DEFAULT 'd',
  `email_activate` enum('y','n') NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `fb_login` enum('y','n') NOT NULL,
  `notifications_emails_number` int(11) NOT NULL DEFAULT '1',
  `remember_code` varchar(255) NOT NULL,
  `forgotten_password_code` varchar(255) NOT NULL,
  `forgotten_password_time` int(11) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `google_id` varchar(255) NOT NULL,
  `reg_type` enum('f','n','g') NOT NULL DEFAULT 'n' COMMENT 'n = normal f = facebook g = google'
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `address`, `city`, `state`, `country`, `phone_number`, `password`, `activation_code`, `salt`, `type`, `status`, `email_activate`, `hash`, `created`, `updated`, `fb_login`, `notifications_emails_number`, `remember_code`, `forgotten_password_code`, `forgotten_password_time`, `fb_id`, `google_id`, `reg_type`) VALUES
(3, 'Admin', 'admin@dimatas.com', 'aaaaaaaa', 'aaaaa', '', '5', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'a', 'a', 'y', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 'CWymlFWRpSJ/iK2mlBPrB.', '', 2147483647, '', '', 'n'),
(4, 'Manan Jobanputra', 'manan.jobanputra@gmail.com', 'Kalawad Road aaaaa', 'Rajkot', 'Gujarat', '7', '+919016968689', '25d55ad283aa400af464c76d713c07ad', '', '', 'u', 'a', 'y', '', '2013-10-03 16:57:49', '0000-00-00 00:00:00', 'n', 7, 'IEiigkVN903I1XkWqk/EjO', '', 2147483647, '', '', 'n'),
(5, 'Test', 'test@dimatas.com', '3242345', 'sadfsfa', '', 'US', '', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 'u', 'a', 'y', '', '2013-10-08 08:54:40', '0000-00-00 00:00:00', 'n', 1, '', '', 2147483647, '', '', 'n'),
(6, 'Chintan Goswami', 'chin2.gsm@gmail.com', '', 'Rajkot', '', 'India', '', '787eff186e68ed716939dc142533b8cb', '', '', 'u', 'a', '', '', '2013-11-16 09:38:28', '0000-00-00 00:00:00', 'y', 1, '', '', 2147483647, '', '', 'n'),
(7, 'Antida Dimatas', 'antida_sales@dimatas.com', '', '', '', '', '', '47b2eee4152ce43363c6adfbbe61963d', '', '', 'u', 'a', '', '', '2014-01-07 09:54:27', '0000-00-00 00:00:00', 'y', 1, '', '', 2147483647, '', '', 'n'),
(9, 'Nandish Sadrani', 'nandishsadrani@gmail.com', 'Rajkot', 'Rajkot', '', 'IN', '', '54a8befb0e2ecd6c7c86343448983935', '', '', 'u', 'a', 'y', '', '2014-02-11 23:48:12', '0000-00-00 00:00:00', 'n', 1, '', '', 2147483647, '', '', 'n'),
(10, 'Rajeev Kamal', 'rajeevkamal@yahoo.com', 'test', 'test', '', 'US', '', 'e2fc714c4727ee9395f324cd2e7f331f', '', '', 'u', 'd', 'y', '', '2014-05-09 11:53:05', '0000-00-00 00:00:00', 'n', 1, '', '', 2147483647, '', '', 'n'),
(11, 'Rajeev Kamal', 'rajeev.kamal@dimatas.com', '97 Winding Wood Dr', 'Princeton', 'nj', 'US', '', 'e2fc714c4727ee9395f324cd2e7f331f', '', '', 'u', 'a', 'y', '', '2014-05-27 11:43:31', '0000-00-00 00:00:00', 'n', 1, '', '', 2147483647, '', '', 'n'),
(12, 'Nikunj', 'nikunj.khakhar@gmail.com', 'india', 'bangalore', '', 'IN', '', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'u', 'a', 'y', '', '2014-07-18 10:47:14', '0000-00-00 00:00:00', 'n', 1, '', '', 2147483647, '', '', 'n'),
(13, 'Motxo ', 'jrminea@gmail.com', 'carrer major', 'barcelona', '', 'ES', '', 'e5a3f6c9ed2ed6e4b924d832dfc64c3d', '', '', 'u', 'a', 'y', '', '2015-01-13 10:28:26', '0000-00-00 00:00:00', 'n', 1, '', '', 2147483647, '', '', 'n'),
(14, 'Demo New User', 'demo@demo.com', 'near rajkot', '', '', 'IN', '', '$2y$08$DvxF04yTJbthFYm92vgyKuyOMo2UHQ5essUpBSBpFlgYCRfslaBeu', '', '', 'u', 'a', 'y', '', '2015-11-08 11:32:37', '0000-00-00 00:00:00', 'y', 1, '', '', 2147483647, '', '', 'n'),
(15, 'jk', 'jem@jem.com', 'Demo admin', '', '', 'IN', '', '$2y$08$DvxF04yTJbthFYm92vgyKuyOMo2UHQ5essUpBSBpFlgYCRfslaBeu', 'abb6cd72357363a768e77b23282c755abac89234', '', 'u', 'd', 'y', '', '2015-11-08 11:43:13', '0000-00-00 00:00:00', 'y', 1, '', '', 0, '', '', 'n'),
(16, 'hitesh', 'dimatas@dayrep.com', 'kalavad road rajkot', 'rajkot', '', '105', '', '$2y$08$75TULii3u0or9455w6VVVuf0Ax64sOPtjkeH91VvPKakQwmYAZQ1u', 'cbaa2d0cfbbb9703159ee2ce1ff6e0dcf6336ab5', '', 'u', '', '', '', '2015-11-17 13:44:53', '0000-00-00 00:00:00', 'y', 1, '', '', 0, '', '', 'n'),
(20, 'aaa', '', 'aaaa', 'rajkot', '', 'India', '', '', '', '', 'u', 'd', 'y', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'y', 1, '', '', 0, '', '', 'n'),
(21, 'aaa', 'aaa@aaaa.com', 'aaaa', 'rajkot', '', 'India', '', 'e10adc3949ba59abbe56e057f20f883e', '477044a536365744518e9e5117c0b725', '', 'u', 'd', 'y', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'y', 1, '', '', 0, '', '', 'n'),
(22, 'Jaem', 'jam@jam.com', 'aaa', 'aadcdfef', '', 'India', '', 'e10adc3949ba59abbe56e057f20f883e', '2576ff8968f40b5d486bb7bd2ef70a12', '', 'u', 'd', 'y', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'y', 1, '', '', 0, '', '', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `users_bk`
--

CREATE TABLE IF NOT EXISTS `users_bk` (
  `id` int(10) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('a','u') NOT NULL COMMENT 'a=admin,u=user',
  `status` enum('a','d') NOT NULL,
  `email_activate` enum('y','n') NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `updated` datetime NOT NULL,
  `fb_login` enum('y','n') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_bk`
--

INSERT INTO `users_bk` (`id`, `full_name`, `email`, `address`, `city`, `country`, `password`, `type`, `status`, `email_activate`, `hash`, `created`, `updated`, `fb_login`) VALUES
(3, 'Admin', 'admin@dimatas.com', '', '', '', 'e10adc3949ba59abbe56e057f20f883e ', 'a', 'a', 'y', '', '0000-00-00', '0000-00-00 00:00:00', ''),
(4, 'Manan', 'manan.jobanputra@gmail.com', 'Kalawad Road', 'Rajkot', 'IN', 'e10adc3949ba59abbe56e057f20f883e', 'u', 'a', 'y', '', '2013-10-03', '0000-00-00 00:00:00', 'n'),
(5, 'Test', 'test@dimatas.com', '3242345', 'sadfsfa', 'US', '81dc9bdb52d04dc20036dbd8313ed055', 'u', 'a', 'y', '', '2013-10-08', '0000-00-00 00:00:00', 'n'),
(6, 'Chintan Goswami', 'chin2.gsm@gmail.com', '', 'Rajkot', 'India', '787eff186e68ed716939dc142533b8cb', 'u', 'a', '', '', '2013-11-16', '0000-00-00 00:00:00', 'y'),
(7, 'Antida Dimatas', 'antida_sales@dimatas.com', '', '', '', '47b2eee4152ce43363c6adfbbe61963d', 'u', 'a', '', '', '2014-01-07', '0000-00-00 00:00:00', 'y'),
(9, 'Nandish Sadrani', 'nandishsadrani@gmail.com', 'Rajkot', 'Rajkot', 'IN', '54a8befb0e2ecd6c7c86343448983935', 'u', 'a', 'y', '', '2014-02-11', '0000-00-00 00:00:00', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `vulnerabilityscan_detail`
--

CREATE TABLE IF NOT EXISTS `vulnerabilityscan_detail` (
  `id` double NOT NULL,
  `host_id` double NOT NULL,
  `user_id` double NOT NULL,
  `status` enum('o','r','p','s','c') NOT NULL DEFAULT 'o' COMMENT 'open running paused stopped completed',
  `target_id` varchar(100) NOT NULL,
  `task_id` varchar(100) NOT NULL,
  `report_id` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `overview` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vulnerabilityscan_detail`
--

INSERT INTO `vulnerabilityscan_detail` (`id`, `host_id`, `user_id`, `status`, `target_id`, `task_id`, `report_id`, `created_date`, `updated_date`, `overview`) VALUES
(2, 1, 4, 'c', '4f45d11f-31a6-41e4-926c-48be6f690ecb', 'dc403915-159c-4567-abef-a15ad011b929', 'db4d6172-c859-440c-aa83-5941f838a66e', '2015-06-27 16:00:51', '2015-07-02 19:44:56', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(3, 2, 4, 'c', '5fcb6761-6417-43a3-bc57-c81bc1c067ad', '8eb736bd-c642-4a16-8270-d1ff182efb2c', '1cd85c68-b3c7-4b69-bfe8-3e99a93a6b7e', '2015-06-29 11:10:41', '2015-07-02 19:44:58', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(4, 3, 11, 'c', '3cb8bb77-0156-429e-87fc-c0d94d1cd2d3', '7289b189-ed8d-4654-9e21-3782d1e589a4', '836826ee-4a4a-43d1-bea1-2784994deb48', '2015-06-29 14:05:18', '2015-07-02 17:44:04', ''),
(5, 4, 4, 'c', 'a62a915c-70d5-4dbf-9bd3-240b75dec5db', '0d22ef58-bfff-4e5b-b133-8492885a81b9', 'af3dd6a5-5718-487d-acd4-04afdd0be7c1', '2015-06-29 14:27:59', '2015-07-02 19:45:00', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(6, 5, 11, 'c', '73f47208-f3c2-417f-99c1-5895b9f64a4e', '3b664dde-9339-4f1a-9f9a-9b74f5a1c170', '4bc61da6-e471-476d-ac07-501f6c00c107', '2015-06-29 14:33:11', '2015-07-02 17:44:05', ''),
(7, 5, 11, 'o', 'cc4c5076-13fa-4e6a-aa5e-6486ff8e40d3', 'f7716160-59d0-4211-b3a2-8aaccc2f4d3d', '0', '2015-06-29 14:33:24', '2015-06-29 14:33:24', ''),
(8, 6, 4, 'c', '23116611-ca7f-48c9-b88d-5675dcdd51b3', 'e22fa15d-6134-40ca-9a19-24186df9f10e', 'ecf99e90-1746-40d9-a719-9fea4df5b039', '2015-06-29 14:46:13', '2015-07-02 19:45:02', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(9, 7, 4, 'c', '490afc9c-f461-41b7-9bec-63d069ec400f', 'f2113dc9-812b-4f8c-b7f8-a51ae6a529e8', '20637dd9-7381-40e5-a14f-680e270ae4de', '2015-06-29 14:48:57', '2015-07-02 19:45:04', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(10, 8, 4, 'c', 'c395e86f-9704-4f49-93a9-c29c7b17a5de', '8ba8bbc6-3898-4199-b539-eead0755322f', 'b7111048-2473-4f63-b89d-61ea0902455c', '2015-06-29 14:49:15', '2015-07-02 19:45:06', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["63.135.90.70","-","-","2015-06-29T20:16:31Z","2015-06-29T20:19:09Z","6.4","Medium","0","1","0","10","0","11"]]'),
(11, 9, 4, 'c', '2ceb4780-964d-4802-a673-5b188727ef0e', 'cac6ac05-c61a-4d69-ba1c-123b9340cd91', '4004c2ea-20c0-4454-812b-514dbe9dea9c', '2015-06-29 14:51:31', '2015-07-02 19:45:07', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["23.235.37.217","-","-","2015-06-29T15:05:26Z","2015-06-29T20:44:44Z","0.0","None","0","0","0","11","0","11"]]'),
(12, 10, 4, 'c', '98a463b2-6fcd-4820-a100-500b15033b55', '951f84b1-7609-4104-846c-a74e18b533b6', 'c2d97cfc-307c-49c0-ad2d-d1b32b848060', '2015-06-29 14:51:53', '2015-07-02 19:45:10', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(13, 11, 4, 'c', '4df8fc8c-d82d-46db-a7dd-f865fc1a739a', '210c518d-e050-4035-b0b1-f34e2d3bc5b0', '60f5c0d0-7f5b-441e-af43-8950dde252b2', '2015-06-29 14:53:32', '2015-07-02 19:45:12', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["119.18.57.101","segi.in","cpe:/o:linux:kernel","2015-06-29T20:29:03Z","2015-06-30T08:00:06Z","7.5","High","2","4","1","69","0","76"]]'),
(14, 12, 4, 'c', 'aa7dbfdd-1cf1-4129-a4c3-40f55202ce6b', '9c435c1c-770b-4bca-a06e-73addbf53a81', '118d9b27-4943-4c52-a050-6bf599bf2ce5', '2015-06-29 15:00:28', '2015-07-02 19:45:13', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(15, 13, 4, 'c', '4d7c5abb-c533-495d-a408-a4c89256a500', '5d57a0ae-2390-401b-9dc8-269dc63af1ec', '70def702-c5ec-47b3-bff0-670738c0da6f', '2015-06-30 08:40:15', '2015-07-02 19:45:15', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["91.190.216.21","-","-","2015-06-30T08:40:53Z","-","0.0","None","0","0","0","6","0","6"]]'),
(16, 14, 4, 'c', '36db5212-839c-4e47-837c-844d4fcc6d51', '5e154277-6c8c-4330-b871-7e552c789fad', '9a7a4c72-6fb3-45fe-9120-3378c843760a', '2015-06-30 08:54:21', '2015-07-02 19:45:17', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(17, 15, 4, 'c', '54387ba9-3400-49ef-83bd-0bc6f7ef4020', '6f678903-5599-483a-9444-dd0282cf8438', '43ad6cb3-93ff-4385-a896-3339e3c810a3', '2015-06-30 08:57:45', '2015-07-02 19:45:19', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["74.125.228.196","-","-","2015-06-30T08:58:04Z","2015-06-30T08:59:41Z","0.0","None","0","0","0","8","0","8"]]'),
(18, 16, 4, 'c', '0b715b63-0cf6-4587-863f-b60222b017f2', 'accae9ab-c72c-43ba-a2d0-11843894dc38', '4883675f-5f19-42f5-8e74-d2aa7f1dc400', '2015-06-30 08:58:11', '2015-07-02 19:45:20', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["173.252.120.6","facebook.com","cpe:/o:microsoft:windows","2015-06-30T08:58:49Z","2015-06-30T09:05:46Z","2.6","Low","0","0","1","12","0","13"]]'),
(19, 17, 4, 'r', '2c78cd5b-5543-498d-b1cf-9cdc09c42e5d', 'f7bd67fa-1588-4bf0-a99e-7a7155852419', '3c4ffd72-ad04-462b-8ec8-32b270d13418', '2015-06-30 13:16:21', '2015-06-30 14:31:32', ''),
(20, 18, 4, 'p', 'ea8be397-d3a3-41ac-bf62-af9f7a0d67d2', '7024be74-1136-408a-9aa9-a03f5fdf3986', 'aa5760c6-eb59-46e5-ab2e-9df09d726e5c', '2015-06-30 15:14:11', '2015-07-20 20:02:20', ''),
(21, 5, 11, 'o', '32cb6d47-56f8-40cf-a6e1-f40f1d786795', 'd1d6dc1c-5363-4ab7-9e77-0d02be7df970', 'cbfb3702-9f13-4cc2-bf6d-e31158556f15', '2015-06-30 15:14:30', '2015-06-30 15:14:30', ''),
(22, 19, 11, 'c', 'b14d22bf-74ee-4527-af2b-7f93ee01785b', '189834da-bcc8-491e-aa8a-3bbcc8eeeb44', '242116f0-35cc-4662-a1cc-d681923d3bab', '2015-06-30 15:16:24', '2015-07-02 17:44:07', ''),
(23, 20, 11, 'o', 'a0200339-cc9a-44b1-888f-ea259d266ea9', '81af6314-a494-4499-b7ef-464cf44771a9', 'cd6202e8-598a-4687-8934-db0e8caeae28', '2015-06-30 15:18:27', '2015-06-30 15:18:27', ''),
(24, 20, 11, 'c', '1df8b6db-7967-426a-8045-2995e38b6e99', '64499b77-78c6-4dac-859d-57f941d8e88a', '71bacfff-a8d8-4525-990d-aa10518f8801', '2015-06-30 15:18:29', '2015-07-02 17:44:09', ''),
(25, 21, 11, 'c', 'ea36ecb3-29c8-4877-a396-85cfe10f7eff', '10f854ac-cd82-4887-8dc7-1def0c731ebe', '6ea05bcd-37d9-4fec-87cf-d8d8396dcdf1', '2015-06-30 15:18:59', '2015-07-02 17:44:10', ''),
(26, 22, 11, 'c', '3dd2e9dc-eac8-4c98-ae8e-70dc07d58bee', '0ef1dc21-c945-4ade-a0fa-c9ecac975bb3', '7c9b6f09-ceda-4b6b-ad1e-871095932d0b', '2015-07-06 18:54:25', '2015-07-06 18:56:44', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(27, 5, 11, 'c', 'c32bec97-e540-4184-85cf-498ea7842f3b', '8707885b-5e5f-44fa-bdeb-02e7bec5f65c', 'd4910223-a31a-4411-bf66-ade2fcb43406', '2015-07-06 18:58:00', '2015-07-06 19:03:04', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(28, 23, 11, 'c', '246e9259-c520-4bc7-853e-3d048d647f61', '7e8f7bbc-ea7d-475f-8f53-fbc6d8b7155b', '491290fd-1cb9-4a45-add5-395d8bb29071', '2015-07-06 19:03:19', '2015-08-12 14:52:03', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(29, 24, 11, 'c', 'f1cf0af3-87d7-4853-a111-b9197a9a3162', '8fc159e6-08f5-4acc-b88c-3edee8885f57', '3dbcf797-eb06-4f7e-a7b4-112bc6304994', '2015-07-06 19:04:10', '2015-07-06 19:14:47', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["54.172.144.121","www.dimatas.com","cpe:/o:canonical:ubuntu_linux","2015-07-06T19:04:17Z","2015-07-06T19:13:02Z","7.5","High","1","2","1","19","0","23"]]'),
(35, 12, 4, 'o', 'f72264c8-89da-41d9-89c0-f4d38ff28e4a', 'bf2b7f72-7493-4016-a8ce-a6acfbd208a3', 'aa076dfa-a872-4a28-a9e9-93084e96d0dc', '2015-07-20 20:21:02', '2015-07-20 20:21:02', ''),
(36, 1, 4, 'o', '5b95d4df-2ff3-4434-be71-9cf96a2e687e', 'e9816bdf-43e1-40b5-8e67-4d542d1fbd2e', '0', '2015-07-20 20:22:59', '2015-07-20 20:22:59', ''),
(37, 4, 4, 'c', '0f697f0a-1416-464c-8666-bc6c1076be20', 'edd58173-8eac-4ae6-b977-287af9fa7357', '91e0d3fd-e35a-4f24-a10a-a0e6bbf59166', '2015-07-20 20:23:28', '2015-07-20 20:23:38', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["-","-","-","-","-","-","-","-","-","-","-","-","-"]]'),
(38, 27, 4, 'c', 'a8d24efd-bcc9-4e73-8468-b94c83d52800', '25f2ec42-df7c-4943-a2b8-bcdf39ad222d', '668c106a-6e81-4f79-b2e4-3f466b67543d', '2015-08-06 14:52:12', '2015-08-06 15:02:03', '[["IP","Hostname","OS","Scan Start","Scan End","CVSS","Severity","High","Medium","Low","Log","False Positive","Total"],["54.172.144.121","dimatas.com","cpe:/o:canonical:ubuntu_linux","2015-08-06T14:53:35Z","2015-08-06T15:00:53Z","7.5","High","1","2","1","19","0","23"]]');

-- --------------------------------------------------------

--
-- Table structure for table `vulnerabilityscan_hosts`
--

CREATE TABLE IF NOT EXISTS `vulnerabilityscan_hosts` (
  `id` double NOT NULL,
  `user_id` double NOT NULL,
  `host_alias` varchar(200) NOT NULL,
  `host_name` varchar(200) NOT NULL,
  `host_ip` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vulnerabilityscan_hosts`
--

INSERT INTO `vulnerabilityscan_hosts` (`id`, `user_id`, `host_alias`, `host_name`, `host_ip`) VALUES
(1, 4, '', 'msn.com', ''),
(2, 4, '', 'gaana.com', ''),
(3, 11, '', 'dimatas.com', ''),
(4, 4, '', 'saavan.com', ''),
(5, 11, '', '3', ''),
(6, 4, '', 'apple.coom', ''),
(7, 4, '', 'alexa.com', ''),
(8, 4, '', 'myspace.com', ''),
(9, 4, '', 'vimeo.com', ''),
(10, 4, '', 'metacafe.com', ''),
(11, 4, '', 'segi.in', ''),
(12, 4, '', 'vodafone.com', ''),
(13, 4, '', 'skype.com', ''),
(14, 4, '', 'moneycontrol.com', ''),
(15, 4, '', 'google.com', ''),
(16, 4, '', 'facebook.com', ''),
(17, 4, '', 'ebuddy.com', ''),
(18, 4, '', 'test.com', ''),
(19, 11, '', 'google.com', ''),
(20, 11, '', 'cnn.com', ''),
(21, 11, '', 'yahoo.com', ''),
(22, 11, '', 'reuters.com', ''),
(23, 11, '', 'Di', ''),
(24, 11, '', 'www.dimatas.com', ''),
(26, 4, '', 'yahoo.com', ''),
(27, 4, '', 'dimatas.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config_management`
--
ALTER TABLE `config_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosts`
--
ALTER TABLE `hosts`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `host_scans`
--
ALTER TABLE `host_scans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `host_services`
--
ALTER TABLE `host_services`
  ADD PRIMARY KEY (`id`), ADD KEY `host_id` (`host_id`), ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `host_user`
--
ALTER TABLE `host_user`
  ADD PRIMARY KEY (`id`), ADD KEY `site_main_host_id` (`site_main_host_id`);

--
-- Indexes for table `host_user_email`
--
ALTER TABLE `host_user_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan_options`
--
ALTER TABLE `scan_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simplyportscan_hosts`
--
ALTER TABLE `simplyportscan_hosts`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_bk`
--
ALTER TABLE `users_bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vulnerabilityscan_detail`
--
ALTER TABLE `vulnerabilityscan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vulnerabilityscan_hosts`
--
ALTER TABLE `vulnerabilityscan_hosts`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config_management`
--
ALTER TABLE `config_management`
  MODIFY `id` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=265;
--
-- AUTO_INCREMENT for table `hosts`
--
ALTER TABLE `hosts`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `host_scans`
--
ALTER TABLE `host_scans`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `host_services`
--
ALTER TABLE `host_services`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `host_user`
--
ALTER TABLE `host_user`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `host_user_email`
--
ALTER TABLE `host_user_email`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scan_options`
--
ALTER TABLE `scan_options`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=262;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `simplyportscan_hosts`
--
ALTER TABLE `simplyportscan_hosts`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users_bk`
--
ALTER TABLE `users_bk`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vulnerabilityscan_detail`
--
ALTER TABLE `vulnerabilityscan_detail`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `vulnerabilityscan_hosts`
--
ALTER TABLE `vulnerabilityscan_hosts`
  MODIFY `id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
