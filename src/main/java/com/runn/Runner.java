package com.runn;

import java.util.Arrays;
import java.util.List;
import java.util.Scanner;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.CommandLineRunner;
import org.springframework.core.annotation.Order;
import org.springframework.stereotype.Component;

import com.entity.Country;
import com.model.Domanda;
import com.model.SessioneQuiz;
import com.repo.CountryRepo;
import com.service.QuizService;

@Order(1)
@Component
public class Runner implements CommandLineRunner{


    @Autowired
    private QuizService quizService;
    
    private Scanner scanner = new Scanner(System.in);
    
    @Override
    public void run(String... args) throws Exception {
        // Only run console mode if specific argument is provided
        if (args.length > 0 && "console".equals(args[0])) {
        
        }
    
    
        while (true) {
            showMainMenu();
            int choice = getChoice();
            
            switch (choice) {
                case 1 -> startQuiz();
                case 2 -> startTraining();
                case 3 -> {
                    System.out.println("Thanks for playing! 👋");
                    return;
                }
                default -> System.out.println("Invalid choice! Please try again.");
            }
        }
    }
    
    private Object startTraining() {
		// TODO Auto-generated method stub
		return null;
	}

	private void showMainMenu() {
        System.out.println("\n📋 MAIN MENU");
        System.out.println("1. 🎯 Start Quiz");
        System.out.println("2. 📚 Training Mode");
        System.out.println("3. 🚪 Exit");
        System.out.print("Choose an option (1-3): ");
    }
    
    private int getChoice() {
        try {
            return Integer.parseInt(scanner.nextLine().trim());
        } catch (NumberFormatException e) {
            return -1;
        }
    }
    
    private void startQuiz() {
        System.out.println("\n🎯 QUIZ MODE");
       
    }}
	
	
