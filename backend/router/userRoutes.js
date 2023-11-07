const express = require('express');
const { jsonParser } = require('../utils/middleware');
const { insertUser, deleteUser, updateUser, fetchUsers } = require('../Functions/userFunction');



const router = express.Router();

// Insert user route
router.post('/register', jsonParser, async (req, res) => {
    try {
        await insertUser({
            email: req.body.email,
            password: req.body.password,
            username: req.body.username,
            balance: req.body.balance,
            bio: req.body.bio,
        });
        res.json({ status: 'ok' });
    } catch (err) {
        res.json({ status: 'error', message: err.message });
    }
});

// Update user route
router.put('/users/:userId', jsonParser, async (req, res) => {
    const userId = req.params.userId;
    const updatedUserData = req.body;

    try {
        await updateUser(userId, updatedUserData);
        res.json({ status: 'ok', message: `User with ID ${userId} updated successfully` });
    } catch (err) {
        res.json({ status: 'error', message: err.message });
    }
});

// Delete user route
router.delete('/users/:userId', async (req, res) => {
    const userId = req.params.userId;

    try {
        await deleteUser(userId);
        res.json({ status: 'ok', message: `User with ID ${userId} deleted successfully` });
    } catch (err) {
        res.json({ status: 'error', message: err.message });
    }
});

// Fetch all users route
router.get('/', async (req, res) => {
    try {
        const users = await fetchUsers();
        res.json({ status: 'ok', users });
    } catch (err) {
        res.json({ status: 'error', message: err.message });
    }
});

module.exports = router;
