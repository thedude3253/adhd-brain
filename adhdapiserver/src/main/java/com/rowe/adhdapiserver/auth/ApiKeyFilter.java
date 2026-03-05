package com.rowe.adhdapiserver.auth;

import java.io.IOException;
import java.util.List;

import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.web.filter.OncePerRequestFilter;

import jakarta.servlet.FilterChain;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

public class ApiKeyFilter extends OncePerRequestFilter {

	private static final String API_KEY = "super-secret-key"; //For demo only. Deployment should use an OAuth2 server instead 
	
	@Override
	protected void doFilterInternal(HttpServletRequest request, HttpServletResponse response, FilterChain filterChain)
			throws ServletException, IOException {
		String authHeader = request.getHeader("Auth");
		System.out.println("DEBUG PRINT: authHeader="+authHeader);
		if(authHeader == null || !authHeader.equals(API_KEY)) {
			response.setStatus(HttpServletResponse.SC_UNAUTHORIZED);
			return;
		}
		UsernamePasswordAuthenticationToken auth = new UsernamePasswordAuthenticationToken("ui-server",null,List.of());
		SecurityContextHolder.getContext().setAuthentication(auth);
		filterChain.doFilter(request, response);
	}

}
