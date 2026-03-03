package com.rowe.adhdapiserver.service;

import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import com.rowe.adhdapiserver.data.User;
import com.rowe.adhdapiserver.data.UserRepository;
import com.rowe.adhdapiserver.request.CreateUserRequest;

@Service
public class UserService {
	private final UserRepository userRepository;
	private final PasswordEncoder passwordEncoder;
	
	public UserService(UserRepository userRepo, PasswordEncoder passEnc) {
		userRepository = userRepo;
		passwordEncoder = passEnc;
	}
	
	public User createUser(CreateUserRequest request) {
		String hash = passwordEncoder.encode(request.getPassword());
		
		User user = new User();
		user.setPassword(hash);
		user.setDisplayName(request.getUsername());
		user.setUserName(request.getUsername());
		
		userRepository.save(user);
		return user;
	}
}
