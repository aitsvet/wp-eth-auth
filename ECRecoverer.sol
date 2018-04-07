pragma solidity ^0.4.21;

contract ECRecoverer {
    
    event ECRecovery(
        bytes32 hash,
        bytes signature,
        address signer);
    
    function recover(bytes32 hash, bytes signature)
    public returns (address) {
        if (signature.length != 65)
            return 0;
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
        address signer = ecrecover(prefixedHash, v, r, s);
        emit ECRecovery(hash, signature, signer);
        return signer;
    }

}