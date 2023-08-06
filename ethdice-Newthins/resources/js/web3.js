<script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>


function generateNewAccount() {
    // Load web3 library
    const Web3 = require('web3');
    // Create a new instance of web3
    const web3 = new Web3('https://dry-frequent-grass.ethereum-goerli.quiknode.pro/');
  
    // Create a new Ethereum account
    const newAccount = web3.eth.accounts.create();
  
    // Log the address and private key of the new account to the console
    console.log('New Ethereum account created:');
    console.log(`Address: ${newAccount.address}`);
    console.log(`Private key: ${newAccount.privateKey}`);
  
    // Return the address and private key
    return {
      address: newAccount.address,
      privateKey: newAccount.privateKey
    };
  }
  