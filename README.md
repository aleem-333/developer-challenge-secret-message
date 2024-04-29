## Overview
This project is based on PHP Laravel, designed to handle the creation, storage, retrieval, and decryption of encrypted messages. The App utilizes Laravel's framework to manage HTTP requests and interact with a database.

## Purpose
The main purpose of this app is to provide a secure mechanism for sending encrypted messages, ensuring that the content remains confidential during transmission and storage. Users can create messages, which are then encrypted using AES-256-CBC encryption before being stored in the database. Recipients can then use a decryption key and identifier to retrieve and decrypt the messages.

## Functionality

> ## EncryptedMessageController

### 1. create()

- Renders a view for creating a new encrypted message.

### 2. show()

- Renders a view for displaying encrypted messages.

### 3. store(StoreRequest $request)

 - Validates the incoming request data.
 - Generates a random decryption key.
 - Encrypts the message text using AES-256-CBC encryption (The 256-bit key size provides a high level of  - security, making it extremely difficult for attackers to decrypt the data without the key).
 - Stores the encrypted message in the database along with relevant metadata.
 - Redirects back to the create view with appropriate messages including identifier and decryption key.

### 4. dcrypt(DcryptRequest $request)

- Handles the decryption of encrypted messages.
- Validates the incoming request data.
- Retrieves the encrypted message based on the recipient identifier.
- Checks if the message is expired.
- Decrypts the message text using the provided decryption key.
- Deletes the message if it is set to be read only once.
- Redirects back with the decrypted text or appropriate error messages.

## Dependencies

- Laravel Framework
- PHP OpenSSL Extension
- PHP SQLITE

## Usage

- Clone the repository to your local machine.
- Run ```composer install``` command to install the laravel dependencies
- Run migrations to create the necessary database tables with ```php artisan migrate```.