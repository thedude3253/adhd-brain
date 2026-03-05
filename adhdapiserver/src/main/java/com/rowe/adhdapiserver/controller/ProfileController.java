package com.rowe.adhdapiserver.controller;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.rowe.adhdapiserver.exception.UsernameAlreadyExistsException;
import com.rowe.adhdapiserver.exception.UsernameDoesNotExistException;
import com.rowe.adhdapiserver.request.AuthorizeProfileRequest;
import com.rowe.adhdapiserver.request.CreateProfileRequest;
import com.rowe.adhdapiserver.service.ProfileService;

import jakarta.validation.Valid;

@RestController
public class ProfileController {
	private final ProfileService userService;
	
	public ProfileController(ProfileService userService) {
		this.userService = userService;
	}
	
	@GetMapping("/user")
	public ResponseEntity<Void> getUser(@RequestParam(value="user") String userUuid) {
		return ResponseEntity.status(HttpStatus.NOT_IMPLEMENTED).build();
	}
	
	@PostMapping("/user")
	public ResponseEntity<Void> createUser(@Valid @RequestBody CreateProfileRequest request) throws UsernameAlreadyExistsException {
		System.out.println("Attempting to create user: "+request.toString());
		userService.createProfile(request);
		return ResponseEntity.status(HttpStatus.CREATED).build();
	}
	
	@PostMapping("/auth")
	public ResponseEntity<Void> authenticateUser(@Valid @RequestBody AuthorizeProfileRequest request) throws UsernameDoesNotExistException {
		if(userService.authenticateProfile(request)) {
			return ResponseEntity.status(HttpStatus.OK).build();
		}
		return ResponseEntity.status(HttpStatus.UNAUTHORIZED).build();
	}
}
