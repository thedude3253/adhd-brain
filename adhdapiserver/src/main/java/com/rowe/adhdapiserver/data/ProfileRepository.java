package com.rowe.adhdapiserver.data;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

@Repository
public interface ProfileRepository extends JpaRepository<Profile, Long> {
	@Query("SELECT COUNT(*) FROM Profile p WHERE p.username= ?1")
	int checkUsernameStatus(String username);
}
