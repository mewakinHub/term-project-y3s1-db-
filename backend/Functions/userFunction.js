const express = require('express');

const { jsonParser } = require('../utils/middleware');
const connection = require('../utils/database');

async function fetchUsers() {
    return new Promise((resolve, reject) => {
        connection.query('SELECT * FROM user', (err, results) => {
            if (err) {
                reject(err);
            } else {
                resolve(results);
            }
        });
    });
}

async function insertUser(userData) {
    return new Promise((resolve, reject) => {
        connection.query(
            'INSERT INTO user (email, password, username, balance, bio , profilePicFile) VALUES (?, ?, ?, ?, ?,?)',
            [userData.email, userData.password, userData.username, userData.balance, userData.bio, userData.profilePicFile,],
            function (err, results) {
                if (err) {
                    reject(err);
                } else {
                    resolve(results);
                }
            }
        );
    });
}

async function updateUser(userId, updatedUserData) {
    return new Promise((resolve, reject) => {
        connection.query(
            'UPDATE user SET email = ?, password = ?, username = ?, balance = ?, bio = ? WHERE userID = ?',
            [
                updatedUserData.email,
                updatedUserData.password,
                updatedUserData.username,
                updatedUserData.balance,
                updatedUserData.bio,
                userId,
            ],
            function (err, results) {
                if (err) {
                    reject(err);
                } else {
                    resolve(results);
                }
            }
        );
    });
}

async function deleteUser(userId) {
    return new Promise((resolve, reject) => {
        connection.query(
            'DELETE FROM user WHERE userID = ?',
            [userId],
            function (err, results) {
                if (err) {
                    reject(err);
                } else {
                    resolve(results);
                }
            }
        );
    });
}


module.exports = {
    fetchUsers,insertUser,deleteUser,updateUser,
};