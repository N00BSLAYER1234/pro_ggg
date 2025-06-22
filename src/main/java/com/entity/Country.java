package com.entity;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "countries")
public class Country {
    @Id
    private String alpha2Code;
    
    private String alpha3Code;
    private String name;
    private String capital;
    private String region;
    private String subregion;
    private String population;
    private String demonym;
    private String flag;
    private String nativeName;
    
    public Country() {}
    
    public Country(String alpha2Code, String name, String capital, String region, String population) {
        this.alpha2Code = alpha2Code;
        this.name = name;
        this.capital = capital;
        this.region = region;
        this.population = population;
    }
    
    public String getAlpha2Code() { 
        return alpha2Code; 
    }
    
    public void setAlpha2Code(String alpha2Code) { 
        this.alpha2Code = alpha2Code; 
    }
    
    public String getAlpha3Code() { 
        return alpha3Code; 
    }
    
    public void setAlpha3Code(String alpha3Code) { 
        this.alpha3Code = alpha3Code; 
    }
    
    public String getName() { 
        return name; 
    }
    
    public void setName(String name) { 
        this.name = name; 
    }
    
    public String getCapital() { 
        return capital; 
    }
    
    public void setCapital(String capital) { 
        this.capital = capital; 
    }
    
    public String getRegion() { 
        return region; 
    }
    
    public void setRegion(String region) { 
        this.region = region; 
    }
    
    public String getSubregion() { 
        return subregion; 
    }
    
    public void setSubregion(String subregion) { 
        this.subregion = subregion; 
    }
    
    public String getPopulation() { 
        return population; 
    }
    
    public void setPopulation(String population) { 
        this.population = population; 
    }
    
    public String getDemonym() { 
        return demonym; 
    }
    
    public void setDemonym(String demonym) { 
        this.demonym = demonym; 
    }
    
    public String getFlagUrl() {
        if (alpha2Code != null && !alpha2Code.trim().isEmpty()) {
            return "/flags/" + alpha2Code.toLowerCase() + ".png";
        }
        return "/flags/default.png";
    }
    
    public String getFlag() { 
        return flag; 
    }
    
    public void setFlag(String flag) { 
        this.flag = flag; 
    }
    
    public String getNativeName() { 
        return nativeName; 
    }
    
    public void setNativeName(String nativeName) { 
        this.nativeName = nativeName; 
    }
}