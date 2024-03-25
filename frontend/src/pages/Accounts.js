import React from 'react';

export default function Accounts() {
    // Sample data (replace with actual data)
    const accounts = [
        { id: 1, user: 'John Doe', balance: 1000 },
        { id: 2, user: 'Jane Smith', balance: 2000 },
        { id: 3, user: 'Alice Johnson', balance: 1500 },
        // Add more accounts as needed
    ];

    const handleSendMoney = (userId) => {
        // Logic for sending money to the user with the specified userId
        console.log('Sending money to user with ID:', userId);
    };

    return (
        <div className="container mt-5">
            <h2 className="text-center mb-4">Accounts</h2>
            <div className="row">
                {accounts.map(account => (
                    <div className="col-md-4 mb-3" key={account.id}>
                        <div className="card">
                            <div className="card-body">
                                <h5 className="card-title">{account.user}</h5>
                                <p className="card-text">Balance: ${account.balance}</p>
                                <button className="btn btn-primary" onClick={() => handleSendMoney(account.id)}>Send Money</button>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}
