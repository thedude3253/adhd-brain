package com.rowe.adhdapiserver;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.RestController;

@SpringBootApplication
@RestController
public class AdhdapiserverApplication {

	public static void main(String[] args) {
		SpringApplication.run(AdhdapiserverApplication.class, args);
	}
}