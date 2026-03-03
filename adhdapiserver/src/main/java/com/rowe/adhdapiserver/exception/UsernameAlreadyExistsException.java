package com.rowe.adhdapiserver.exception;

public class UsernameAlreadyExistsException extends Exception {
	private static final long serialVersionUID = -2680350473878129516L;
	@Override
	public String toString() {
		return "Username already in use";
	}
}
