package com.rowe.adhdapiserver.data;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Profile {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	
	private String displayname;
	
	@Column(name="username", unique=true, nullable=false)
	private String username;
	private String hash;
	
	public String getDisplayName() {
		return displayname;
	}
	public void setDisplayName(String newName) {
		displayname = newName;
	}
	public String getUserName() {
		return username;
	}
	public void setUserName(String userName) {
		this.username = userName;
	}
	public String getHash() {
		return hash;
	}
	public void setPassword(String hash) {
		this.hash = hash;
	}
}
