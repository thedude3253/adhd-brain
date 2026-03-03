package com.rowe.adhdapiserver.controller;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.rowe.adhdapiserver.request.CreateUserRequest;
import com.rowe.adhdapiserver.service.UserService;

import jakarta.validation.Valid;

@RestController
public class UserController {
	private final UserService userService;
	
	public UserController(UserService userService) {
		this.userService = userService;
	}
	
	@GetMapping("/user")
	public ResponseEntity<Void> getUser(@RequestParam(value="user") String userUuid) {
		return ResponseEntity.status(HttpStatus.NOT_IMPLEMENTED).build();
	}
	
	@PostMapping("/user")
	public ResponseEntity<Void> createUser(@Valid @RequestBody CreateUserRequest request) {
		userService.createUser(request);
		return ResponseEntity.status(HttpStatus.CREATED).build();
	}
}
