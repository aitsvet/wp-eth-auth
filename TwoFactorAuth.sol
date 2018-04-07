pragma solidity ^0.4.21;

contract TwoFactorAuth {
    
    event LoginAttempt(
        address user,
        bytes32 hash,
        bytes signature,
        bool result);
    
    function login(address user, bytes32 hash, bytes signature)
    public returns (bool) {
        bool result = verify(user, hash, signature);
        emit LoginAttempt(user, hash, signature, result);
        return result;
    }
    
    function verify(address user, bytes32 hash, bytes signature)
    public pure returns (bool) {
        if (signature.length != 65)
            return false;
        bytes memory prefix = "\x19Ethereum Signed Message:\n32";
        bytes32 prefixedHash = keccak256(prefix, hash);
        bytes32 r;
        bytes32 s;
        uint8 v;
        assembly {
            r := mload(add(signature, 32))
            s := mload(add(signature, 64))
            v := byte(0, mload(add(signature, 96)))
        }
        if (v < 27)
            v += 27;
        return ecrecover(prefixedHash, v, r, s) == user;
    }

}