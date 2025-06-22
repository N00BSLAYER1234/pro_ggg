package com.repo;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import com.entity.Country;

@Repository
public interface CountryRepo extends JpaRepository<Country, String> {
    
    @Query("SELECT c FROM Country c WHERE c.capital IS NOT NULL AND c.capital != ''")
    List<Country> findCountriesWithCapital();
    
    @Query("SELECT c FROM Country c WHERE c.region IS NOT NULL AND c.region != ''")
    List<Country> findCountriesWithRegion();
    
    @Query("SELECT c FROM Country c WHERE c.population IS NOT NULL AND c.population != ''")
    List<Country> findCountriesWithPopulation();
    
    List<Country> findByRegion(String region);
}