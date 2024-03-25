import React from 'react';

export default function Transaction() {
    
    const transactions = [
        { id: 1, amount: 1000, type: 'Recharge', date: '2021-09-01' },
        { id: 2, amount: 500, type: 'Retrait', date: '2021-09-02' },
        { id: 3, amount: 2000, type: 'Recharge', date: '2021-09-03' },
    ];

    return (
        <div className=" mt-5">
            <div className="row justify-content-center">
                <div className="col-md-10">
                    <div className="card">
                        <div className="card-body">
                            <h2 className="card-title text-center mb-4">Transaction History</h2>
                            <div className="table-responsive">
                                <table className="table table-striped">
                                    <thead className="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Montant</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {transactions.map(transaction => (
                                            <tr key={transaction.id}>
                                                <th scope="row">{transaction.id}</th>
                                                <td>{transaction.amount}</td>
                                                <td>{transaction.type}</td>
                                                <td>{transaction.date}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
