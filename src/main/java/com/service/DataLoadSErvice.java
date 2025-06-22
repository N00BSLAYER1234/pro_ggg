package com.service;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.entity.Country;
import com.repo.CountryRepo;

@Service
public class DataLoadSErvice {

	
	@Autowired
    private CountryRepo countryRepository;
    
    /**
     * Load countries data from CSV file in classpath
     * CSV format: alpha2Code,name,capital,region,subregion,population,demonym
     */
    public void loadCountriesFromCSV(String csvFileName) {
        try (InputStream inputStream = getClass().getClassLoader().getResourceAsStream(csvFileName);
             BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream))) {
            
            List<Country> countries = new ArrayList<>();
            String line;
            boolean isFirstLine = true;
            
            while ((line = reader.readLine()) != null) {
                if (isFirstLine) {
                    isFirstLine = false; // Skip header
                    continue;
                }
                
                String[] data = line.split(",");
                if (data.length >= 7) {
                    Country country = new Country();
                    country.setAlpha2Code(data[0].trim());
                    country.setName(data[1].trim());
                    country.setCapital(data[2].trim());
                    country.setRegion(data[3].trim());
                    country.setSubregion(data[4].trim());
                    country.setPopulation(data[5].trim());
                    country.setDemonym(data[6].trim());
                    
                    countries.add(country);
                }
            }
            
            if (!countries.isEmpty()) {
                countryRepository.saveAll(countries);
                System.out.println("Loaded " + countries.size() + " countries from CSV");
            }
            
        } catch (Exception e) {
            System.err.println("Error loading countries from CSV: " + e.getMessage());
            throw new RuntimeException("Failed to load countries data", e);}
        }
        public void loadCountriesFromAPI() {
            // This would connect to an external API like:
            // https://restcountries.com/v3.1/all
            // Implementation depends on your requirements
            throw new UnsupportedOperationException("API loading not implemented. Use CSV or SQL data.");
        }
    }

	



