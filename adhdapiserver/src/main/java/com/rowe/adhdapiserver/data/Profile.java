package com.rowe.adhdapiserver.data;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Profile {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	
	private String displayName;
	private String userName;
	private String hash;
	
	public String getDisplayName() {
		return displayName;
	}
	public void setDisplayName(String newName) {
		displayName = newName;
	}
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getHash() {
		return hash;
	}
	public void setPassword(String hash) {
		this.hash = hash;
	}
}
