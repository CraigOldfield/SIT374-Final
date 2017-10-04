<?php
  session_start();

  $data = $_SESSION['downloadFile'];
  $buttonClicked = $_SESSION['buttonClicked'];
  $data = explode(",", $data);

  header("Content-type: text/plain");
	
	//////////////////////////////VAGRANT CONFIG ///////////////////////////////////////////////
	if ($buttonClicked == "VagrantConfig") {
		header("Content-Disposition: attachment; filename=Vagrantfile");
		
		print "Vagrant.configure(\"2\") do |config|";
		print "\r\n\tconfig.vm.box = \"ubuntu\/trusty64\"";
		if ($data[7] != "1")
		{
			print "\r\n\t(1..$data[7]).each do |i|";		
			print "\r\n\t\tconfig.vm.define \"node#{i}\", autostart:true do |node|";
			print "\r\n\t\t\tnode.vm.hostname=\"node#{i}\"";
			print "\r\n\t\t\tnode.vm.network \"private_network\", ip: \"192.168.59.#{i+1}\"";
			print "\r\n\t\t\tnode.vm.provider \"virtualbox\" do |v|";
			print "\r\n\t\t\t\tv.name = \"node#{i}\"";
			if ($data[5] == 8)
			{
				print "\r\n\t\t\t\tv.memory = 8192";
			} else {
				print "\r\n\t\t\t\tv.memory = 16384";
			}
			print "\r\n\t\t\t\tv.cpus = $data[8]";
			print "\r\n\t\t\tend";
			print "\r\n\t\tend";
			print "\r\n\tend";
			print "\r\nend";
		} else {		
			print "\r\n\t\tconfig.vm.define \"node1\", autostart:true do |node|";
			print "\r\n\t\t\tnode.vm.hostname=\"node1\"";
			print "\r\n\t\t\tnode.vm.network \"private_network\", ip: \"192.168.59.10\"";
			print "\r\n\t\t\tnode.vm.provider \"virtualbox\" do |v|";
			print "\r\n\t\t\t\tv.name = \"node1\"";
			if ($data[5] == 8)
			{
				print "\r\n\t\t\t\tv.memory = 8192";
			} else {
				print "\r\n\t\t\t\tv.memory = 16384";
			}
			print "\r\n\t\t\t\tv.cpus = $data[8]";
			print "\r\n\t\t\tend";
			print "\r\n\t\tend";
			print "\r\nend";
		}
	}
	//////////////////////////////ANSIBLE ///////////////////////////////////////////////
	if ($buttonClicked == "AnsiblePlaybook") {
	  if ($data[0] == 'view'){

		header("Content-Disposition: attachment; filename=Playbook.yml");
		
		print "---";
		print "\r\n- hosts: all";
		print "\r\n  become: true";
		print "\r\n  become_method: sudo";
		print "\r\n  tasks:";
		print "\r\n   - name: Install base packages";
		print "\r\n     apt: pkg={{ item }} state=present update_cache=yes";
		print "\r\n     with_items:";
		print "\r\n      - git";
		print "\r\n      - vim";
		print "\r\n     tags:";
		print "\r\n      - git";
		print "\r\n";
		print "\r\n   - name: Install R";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - r-base";
		print "\r\n     tags:";
		print "\r\n      - R";
		print "\r\n";
		print "\r\n   - name: Install Python";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - python-dev";
		print "\r\n     tags:";
		print "\r\n      - Python";
		print "\r\n";
		print "\r\n   - name: Install SQL Server";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - mysql-server";
		print "\r\n     tags:";
		print "\r\n      - SQL Server";
		print "\r\n";
		print "\r\n   - name: Install PHP";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - php5";
		print "\r\n     tags:";
		print "\r\n      - PHP";
		print "\r\n";
		print "\r\n   - name: Install Okta";
		print "\r\n     apt:";
		print "\r\n     deb: dpkg -i OktaLDAPAgent_xx.xx.xx_amd64.deb";
		print "\r\n     tags:";
		print "\r\n      - Okta";
		print "\r\n";
		print "\r\n   - name: Install Unity";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - unity";
		print "\r\n     tags:";
		print "\r\n      - Unity";
		print "\r\n";
		print "\r\n   - name: Install Ruby";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - ruby-dev";
		print "\r\n     tags:";
		print "\r\n      - Ruby";
		print "\r\n";
		print "\r\n   - name: Install .NET";
		print "\r\n     apt:";
		print "\r\n     deb: dpkg -i libicu52_52.1-3ubuntu0.4_amd64.deb";
		print "\r\n     tags:";
		print "\r\n      - .NET";
		print "\r\n";
		print "\r\n   - name: Install Weka";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - weka";
		print "\r\n     tags:";
		print "\r\n      - Weka";
		print "\r\n";
		print "\r\n   - name: Install Apache Drill";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - apache2";
		print "\r\n     tags:";
		print "\r\n      - Apache Drill";
		print "\r\n";
		print "\r\n   - name: Install Centrify";
		print "\r\n     apt:";
		print "\r\n     deb: centrify";
		print "\r\n     tags:";
		print "\r\n      - Centrify";
		print "\r\n";
		print "\r\n   - name: Install React Native";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     with_items:";
		print "\r\n      - nodejs";
		print "\r\n     tags:";
		print "\r\n      - React Native";
		print "\r\n";
		print "\r\n   - name: Install Zscaler";
		print "\r\n     apt:";
		print "\r\n     pkg: ffoo.crt /usr/local/share/ca-certificates/foo.crt";
		print "\r\n     tags:";
		print "\r\n      - Zscaler";
		print "\r\n";
		print "\r\n   - name: Install ClipherCloud";
		print "\r\n     apt:";
		print "\r\n     deb: cliphercloud";
		print "\r\n     tags:";
		print "\r\n      - ClipherCloud";
		print "\r\n";
		print "\r\n   - name: Install IOS SDK";
		print "\r\n     apt:";
		print "\r\n     deb: iossdk";
		print "\r\n     tags:";
		print "\r\n      - IOS SDK";
		print "\r\n";
		print "\r\n   - name: Install Android SDK";
		print "\r\n     apt: pkg={{ item }} state=latest";
		print "\r\n     deb: androidsdk";
		print "\r\n     tags:";
		print "\r\n      - Android SDK";
		print "\r\n";
		print "\r\n   - name: Install Xamarin";
		print "\r\n     apt:";
		print "\r\n     deb: xamarin";
		print "\r\n     tags:";
		print "\r\n      - Xamarin";
		print "\r\n";
		print "\r\n   - name: Install IOS";
		print "\r\n     apt:";
		print "\r\n     deb: IOS";
		print "\r\n     tags:";
		print "\r\n      - IOS";
		print "\r\n";
		print "\r\n   - name: Install DocTrackr";
		print "\r\n     apt:";
		print "\r\n     deb: doctrackr";
		print "\r\n     tags:";
		print "\r\n      - DocTrackr";
		print "\r\n";
		print "\r\n   - name: Install Vaultive";
		print "\r\n     apt:";
		print "\r\n     deb: vaultive";
		print "\r\n     tags:";
		print "\r\n      - Vaultive";
		}
	}
?>