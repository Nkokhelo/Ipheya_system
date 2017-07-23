-- phpmyadmin sql dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- host: 127.0.0.1
-- generation time: jul 12, 2017 at 07:29 pm
-- server version: 5.7.14
-- php version: 5.6.25

set sql_mode = "no_auto_value_on_zero";
set time_zone = "+00:00";


/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!40101 set names utf8mb4 */;

--
-- database: `ipheya2`
--
create database if not exists `ipheya2` default character set latin1 collate latin1_swedish_ci;
use `ipheya2`;

-- --------------------------------------------------------

--
-- table structure for table `clients`
--

create table `clients` (
  `client_id` int(11) not null,
  `client_no` varchar(15) not null,
  `name` varchar(100) default null,
  `surname` varchar(100) default null,
  `email` varchar(100) default null,
  `postal_address` text,
  `contact_number` varchar(10) default null,
  `account` varchar(255) default null,
  `archived` int(11) default null,
  `token` varchar(255) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `client_r_q`
--

create table `client_r_q` (
  `request_id` int(11) not null,
  `qoutation_id` varchar(11) not null,
  `requesttype` varchar(15) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `departments`
--

create table `departments` (
  `department_id` int(11) not null,
  `department` varchar(100) default null,
  `email` varchar(100) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `employees`
--

create table `employees` (
  `employee_id` int(11) not null,
  `emp_no` varchar(10) not null,
  `name` varchar(100) default null,
  `surname` varchar(100) default null,
  `title` varchar(10) default null,
  `date_of_birth` date default null,
  `gender` varchar(100) default null,
  `email` varchar(175) default null,
  `phone_number` varchar(10) default null,
  `identity_number` varchar(13) default null,
  `postal_address` text,
  `residential_address` text,
  `department_id` int(11) default null,
  `password` varchar(255) default null,
  `token` varchar(255) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `employeetask`
--

create table `employeetask` (
  `employee_id` int(11) not null,
  `task_id` int(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `included_departments`
--

create table `included_departments` (
  `request_id` int(11) not null,
  `department_id` int(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `maintenancerequest`
--

create table `maintenancerequest` (
  `request_id` int(11) not null,
  `client_id` int(11) default null,
  `service_id` int(11) default null,
  `description` text,
  `requestdate` date default null,
  `requeststatus` varchar(50) default null,
  `maintenancefrequency` varchar(50) default null,
  `maintenanceperiod` int(11) default null,
  `enddate` date default null,
  `requesttype` varchar(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `notifications`
--

create table `notifications` (
  `notific_id` int(11) not null,
  `user_email` varchar(100) default null,
  `notific_message` varchar(150) default null,
  `notific_date` datetime default null,
  `unread` int(3) default null,
  `notific_link` varchar(500) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `payments`
--

create table `payments` (
  `payment_id` varchar(50) not null,
  `amount_paid` float(10,2) not null,
  `date` datetime default null,
  `payment_status` varchar(255) default null,
  `client_id` int(11) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `qoutation`
--

create table `qoutation` (
  `qoutation_id` varchar(11) not null,
  `title` varchar(30) default null,
  `summary` varchar(300) default null,
  `paymentmethord` varchar(30) default null,
  `amountdue` float not null,
  `expiringdate` date default null,
  `qoutationdate` date default null,
  `status` varchar(1) not null,
  `request_id` int(3) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `qoutationitems`
--

create table `qoutationitems` (
  `qoutationitem_id` int(11) not null,
  `name` varchar(100) default null,
  `description` varchar(300) not null,
  `unitprice` double default null,
  `quantity` int(5) default null,
  `totalprice` double not null,
  `supplier` varchar(30) not null,
  `status` varchar(1) not null,
  `purchasedate` datetime default null,
  `qoutation_id` varchar(11) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `repairrequest`
--

create table `repairrequest` (
  `request_id` int(11) not null,
  `client_id` int(11) default null,
  `service_id` int(11) default null,
  `description` text,
  `requestdate` date default null,
  `requeststatus` varchar(50) default null,
  `surveyingdate` date default null,
  `requesttype` varchar(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `roles`
--

create table `roles` (
  `role_id` int(11) not null,
  `name` varchar(50) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `servicerequest`
--

create table `servicerequest` (
  `request_id` int(11) not null,
  `client_id` int(11) default null,
  `service_id` int(11) default null,
  `description` text,
  `requestdate` date default null,
  `requeststatus` varchar(50) default null,
  `surveyingdate` date not null,
  `duration` int(11) default null,
  `warrant` int(11) default null,
  `duedate` date default null,
  `requesttype` varchar(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `services`
--

create table `services` (
  `service_id` int(11) not null,
  `service` varchar(100) default null,
  `min_duration` varchar(50) default null,
  `durationtype` varchar(30) not null,
  `description` text,
  `department_id` int(11) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `suppliers`
--

create table `suppliers` (
  `supplier_no` varchar(10) not null,
  `company_name` varchar(100) default null,
  `address` varchar(100) default null,
  `line2` varchar(100) default null,
  `line3` varchar(100) default null,
  `line4` varchar(100) default null,
  `post_code` varchar(10) default null,
  `contact_name` varchar(150) default null,
  `telephone` varchar(13) default null,
  `mobile` varchar(15) default null,
  `fax` varchar(15) default null,
  `web` varchar(100) default null,
  `email` varchar(200) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `surveying`
--

create table `surveying` (
  `surveying_id` int(11) not null,
  `request_id` int(11) default null,
  `description` text,
  `image` longblob
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `targets`
--

create table `targets` (
  `target_id` int(11) not null,
  `ip_address` varchar(50) default null,
  `first_visit` date default null,
  `last_visit` date default null,
  `total_visits` int(11) default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `task`
--

create table `task` (
  `task_id` int(3) not null,
  `name` varchar(30) default null,
  `duration` int(3) default null,
  `durationtype` varchar(15) default null,
  `location` varchar(50) default null,
  `startdate` date default null,
  `enddate` date default null,
  `description` text,
  `dateposted` datetime default null,
  `request_id` int(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `technicalobservation`
--

create table `technicalobservation` (
  `request_id` int(11) not null,
  `client_id` int(11) default null,
  `service_id` int(11) default null,
  `observation` varchar(100) default null,
  `description` text,
  `requestdate` date default null,
  `requeststatus` varchar(50) default null,
  `physicaladdress` text,
  `requesttype` varchar(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `ticket`
--

create table `ticket` (
  `id` int(11) not null,
  `client_id` int(6) unsigned not null,
  `subject` varchar(50) not null,
  `requesttype` varchar(30) not null,
  `problemdescription` text not null,
  `status` varchar(15) not null,
  `dateplaced` datetime default null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `userroles`
--

create table `userroles` (
  `role_id` int(11) not null,
  `user_id` int(11) not null
) engine=myisam default charset=latin1;

-- --------------------------------------------------------

--
-- table structure for table `users`
--

create table `users` (
  `user_id` int(11) not null,
  `username` varchar(256) not null,
  `email` varchar(256) default null,
  `emailconfirmed` bit(1) not null,
  `password` varchar(500) not null
) engine=myisam default charset=latin1;

--
-- indexes for dumped tables
--

--
-- indexes for table `clients`
--
alter table `clients`
  add primary key (`client_id`);

--
-- indexes for table `client_r_q`
--
alter table `client_r_q`
  add primary key (`requesttype`,`qoutation_id`),
  add key `qoutation_id` (`qoutation_id`);

--
-- indexes for table `departments`
--
alter table `departments`
  add primary key (`department_id`);

--
-- indexes for table `employees`
--
alter table `employees`
  add primary key (`employee_id`),
  add key `department_id` (`department_id`);

--
-- indexes for table `employeetask`
--
alter table `employeetask`
  add primary key (`employee_id`,`task_id`),
  add key `task_id` (`task_id`);

--
-- indexes for table `included_departments`
--
alter table `included_departments`
  add primary key (`request_id`,`department_id`),
  add key `department_id` (`department_id`);

--
-- indexes for table `maintenancerequest`
--
alter table `maintenancerequest`
  add primary key (`request_id`),
  add key `client_id` (`client_id`),
  add key `service_id` (`service_id`);

--
-- indexes for table `notifications`
--
alter table `notifications`
  add primary key (`notific_id`),
  add key `user_email` (`user_email`);

--
-- indexes for table `payments`
--
alter table `payments`
  add primary key (`payment_id`),
  add key `client_id` (`client_id`);

--
-- indexes for table `qoutation`
--
alter table `qoutation`
  add primary key (`qoutation_id`);

--
-- indexes for table `qoutationitems`
--
alter table `qoutationitems`
  add primary key (`qoutationitem_id`),
  add key `qoutation_id` (`qoutation_id`);

--
-- indexes for table `repairrequest`
--
alter table `repairrequest`
  add primary key (`request_id`),
  add key `client_id` (`client_id`),
  add key `service_id` (`service_id`);

--
-- indexes for table `roles`
--
alter table `roles`
  add primary key (`role_id`);

--
-- indexes for table `servicerequest`
--
alter table `servicerequest`
  add primary key (`request_id`),
  add key `client_id` (`client_id`),
  add key `service_id` (`service_id`);

--
-- indexes for table `services`
--
alter table `services`
  add primary key (`service_id`),
  add key `department_id` (`department_id`);

--
-- indexes for table `suppliers`
--
alter table `suppliers`
  add primary key (`supplier_no`);

--
-- indexes for table `surveying`
--
alter table `surveying`
  add primary key (`surveying_id`),
  add key `request_id` (`request_id`);

--
-- indexes for table `targets`
--
alter table `targets`
  add primary key (`target_id`);

--
-- indexes for table `task`
--
alter table `task`
  add primary key (`task_id`),
  add key `request_id` (`request_id`);

--
-- indexes for table `technicalobservation`
--
alter table `technicalobservation`
  add primary key (`request_id`),
  add key `client_id` (`client_id`),
  add key `service_id` (`service_id`);

--
-- indexes for table `ticket`
--
alter table `ticket`
  add primary key (`client_id`);

--
-- indexes for table `userroles`
--
alter table `userroles`
  add primary key (`role_id`,`user_id`),
  add key `user_id` (`user_id`);

--
-- indexes for table `users`
--
alter table `users`
  add primary key (`user_id`);

--
-- auto_increment for dumped tables
--

--
-- auto_increment for table `clients`
--
alter table `clients`
  modify `client_id` int(11) not null auto_increment, auto_increment=14;
--
-- auto_increment for table `departments`
--
alter table `departments`
  modify `department_id` int(11) not null auto_increment, auto_increment=8;
--
-- auto_increment for table `employees`
--
alter table `employees`
  modify `employee_id` int(11) not null auto_increment, auto_increment=8;
--
-- auto_increment for table `maintenancerequest`
--
alter table `maintenancerequest`
  modify `request_id` int(11) not null auto_increment, auto_increment=4;
--
-- auto_increment for table `notifications`
--
alter table `notifications`
  modify `notific_id` int(11) not null auto_increment;
--
-- auto_increment for table `qoutationitems`
--
alter table `qoutationitems`
  modify `qoutationitem_id` int(11) not null auto_increment, auto_increment=26;
--
-- auto_increment for table `repairrequest`
--
alter table `repairrequest`
  modify `request_id` int(11) not null auto_increment;
--
-- auto_increment for table `roles`
--
alter table `roles`
  modify `role_id` int(11) not null auto_increment, auto_increment=13;
--
-- auto_increment for table `servicerequest`
--
alter table `servicerequest`
  modify `request_id` int(11) not null auto_increment, auto_increment=5;
--
-- auto_increment for table `services`
--
alter table `services`
  modify `service_id` int(11) not null auto_increment, auto_increment=7;
--
-- auto_increment for table `surveying`
--
alter table `surveying`
  modify `surveying_id` int(11) not null auto_increment, auto_increment=15;
--
-- auto_increment for table `targets`
--
alter table `targets`
  modify `target_id` int(11) not null auto_increment, auto_increment=3;
--
-- auto_increment for table `task`
--
alter table `task`
  modify `task_id` int(3) not null auto_increment, auto_increment=38;
--
-- auto_increment for table `technicalobservation`
--
alter table `technicalobservation`
  modify `request_id` int(11) not null auto_increment, auto_increment=2;
--
-- auto_increment for table `users`
--
alter table `users`
  modify `user_id` int(11) not null auto_increment, auto_increment=18;
/*!40101 set character_set_client=@old_character_set_client */;
/*!40101 set character_set_results=@old_character_set_results */;
/*!40101 set collation_connection=@old_collation_connection */;
