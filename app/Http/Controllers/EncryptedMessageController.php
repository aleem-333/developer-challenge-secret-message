<?php

namespace App\Http\Controllers;

use App\Http\Requests\DcryptRequest;
use App\Http\Requests\StoreRequest;
use App\Models\EncryptedMessage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class EncryptedMessageController extends Controller
{
    public function create()
    {
        return view('create');
    }
    public function show()
    {
        return view('show');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $decryptionKey = Str::random(32);
        try {
            $encrypter = new Encrypter($decryptionKey, 'AES-256-CBC');
            $encryptedText = $encrypter->encryptString($request->text);
        } catch (Exception $e) {
            return redirect()->back()->with('text', $e->getMessage());
        }

        $encryptedMessage = EncryptedMessage::create([
            'text' => $encryptedText,
            'recipient' => $data['recipient'],
            'expires_at' => $data['expires_at'],
            'read_once' => $data['read_once'] ?? false,
            'decryption_key' => $decryptionKey,
        ]);

        return redirect()->back()->with(['message' => $encryptedMessage])->withInput();
    }

    public function dcrypt(DcryptRequest $request)
    {
        $data = $request->validated();
        $encryptedMessage = EncryptedMessage::where('recipient', $data['identifier'])->first();
        if (!$encryptedMessage) {
            return redirect()->back()->with(['text' => 'Message not found.']);
        }
        // Check if message is expired
        if ($encryptedMessage->expires_at && now()->greaterThan($encryptedMessage->expires_at)) {
            $encryptedMessage->delete();
            return redirect()->back()->with(['text' => 'Message has expired.']);
        }
        $decryptionKey = $data['decryption_key'];
        $cipher = "AES-256-CBC";

        try {
            $encrypter = new Encrypter($decryptionKey, $cipher);
            $decryptedText = $encrypter->decryptString($encryptedMessage->text);
        } catch (Exception $e) {
            return redirect()->back()->with('text', 'Invalid decryption key.');
        }

        // Check if message is set to be read only once
        if ($encryptedMessage->read_once) {
            $encryptedMessage->delete();
        }

        return redirect()->back()->with(['text' => $decryptedText]);
    }
}
