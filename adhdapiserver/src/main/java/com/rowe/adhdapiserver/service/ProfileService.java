package com.rowe.adhdapiserver.service;

import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import com.rowe.adhdapiserver.data.Profile;
import com.rowe.adhdapiserver.data.ProfileRepository;
import com.rowe.adhdapiserver.exception.UsernameAlreadyExistsException;
import com.rowe.adhdapiserver.request.CreateProfileRequest;

@Service
public class ProfileService {
	private final ProfileRepository userRepository;
	private final PasswordEncoder passwordEncoder;
	
	public ProfileService(ProfileRepository userRepo, PasswordEncoder passEnc) {
		userRepository = userRepo;
		passwordEncoder = passEnc;
	}
	
	public Profile createProfile(CreateProfileRequest request) throws UsernameAlreadyExistsException {
		System.out.println(String.format("Checking if user %s already exists.",request.getUsername()));
		if(userRepository.checkUsernameStatus(request.getUsername()) > 0) {
			//Username is not unique
			throw new UsernameAlreadyExistsException();
		}
		System.out.println("Creating user...");
		String hash = passwordEncoder.encode(request.getPassword());
		System.out.println("User Hash: "+hash);
		Profile user = new Profile();
		user.setPassword(hash);
		user.setDisplayName(request.getUsername());
		user.setUserName(request.getUsername());
		System.out.println("User Created. Saving to database...");
		userRepository.save(user);
		System.out.println("User Saved. Returning created User.");
		return user;
	}
}
