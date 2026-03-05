package com.rowe.adhdapiserver.request;

import jakarta.validation.constraints.NotBlank;

public class CreateProfileRequest {
	
	@NotBlank
	private String username;
	@NotBlank
	private String password;
	
    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
    
    @Override
    public String toString() {
    	return String.format("Username:%s%nPassword:%s",username,password);
    }
}
